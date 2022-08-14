<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class project extends Model
{
    use Notifiable;
    const TYPE_FIXED = 'fixed';
    const TYPE_HOURLY = 'hourly';
    // protected $guarded = [];
    protected $fillable = [
        'title', ' type', 'category_id', 'user_id', 'description', 'budget', 'status', 'attachments'
    ];
    protected $hidden = ['updated_at', 'created_at'];
    protected $appends = ['type_name'];
    protected $casts = [
        'budget' => 'float',
        'attachments' => 'json',
    ];
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(user::class, 'user_id', 'id');
    }
    public static function types()
    {
        return [
            self::TYPE_HOURLY => 'hourly',
            self::TYPE_FIXED => 'fixed',
        ];
    }

    public static function status()
    {
        return [
            'open',
            'in-progress',
            'closed'
        ];
    }

    public static function booted()
    {
        static::addGlobalScope('active', function (Builder $builder) {
            $builder->where('status', '=', 'open');
        });
    }
    public function scopeHourly(Builder $builder)
    {
        $builder->where('type','hourly');
    }
    public function scopeClosed(Builder $builder)
    {
        $builder->where('status','closed');
    }
    public function scopeFilter(Builder $builder,$filters = [])
    {
        $filters = array_merge([
            'type'=> null,
            'status'=> null,
            'budget_min'=>null,
        ],$filters);

        if($filters['type'])
        {
            $builder->where('type','=',$filters['type']);
        }
        $builder->when($filters['status'],function($builder , $value){
            $builder->where('status' ,'=',$value);
        });
        $builder->when($filters['budget_min'],function( $builder , $value){
            $builder->where('budget' ,'=',$value);
        });
    }

    public function getTypeNameAttribute()
    {
        return ucfirst($this->type);
    }
    public function category()
    {
        return $this->belongsTo(category::class, 'category_id', 'id');
    }
    public function tags()
    {
        return $this->belongsToMany(
            tag::class, //realted model
            'project_tag',  //pivot table
            'project_id',   //f.k for current model in pivot table
            'tag_id',       //f.k for realted model in pivot table
            'id',           //current model ket (primary key)
            'id'            //related model key (primary key related model)
        );
    }
    public  function syncTags(array $tags)
    {
        $tags_id = [];
        foreach ($tags as $tag_name) {
            $tag = tag::firstOrCreate([
                'slug' => Str::slug($tag_name)
            ], [
                'name' =>  trim($tag_name)
            ]);
            $tags_id = $tag->id;
        }
        $this->tags()->sync($tags_id);
    }
    public function proposals()
    {
        return $this->hasMany(Proposal::class, 'project_id', 'id');
    }
    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }
    public function proposedFreelancers()
    {
        return $this->belongsToMany(
            User::class,
            'proposals',
            'project_id',
            'freelancer_id',

        )->withPivot([
            'cost', 'type', 'status', 'start_on', 'end_on', 'completed_on', 'hours'
        ]);
    }
    public function contractedFreelancers()
    {
        return $this->belongsToMany(
            User::class,
            'contracts',
            'project_id',
            'freelancer_id',
        )->withPivot([
            'cost', 'type', 'status', 'start_on', 'end_on', 'completed_on', 'hours'
        ]);
    }
}
