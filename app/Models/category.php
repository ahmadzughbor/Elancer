<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'name','slug','parent_id','description','art_path'
    ];
    protected $hidden = ['updated_at','created_at'];
    public function projects()
    {
        return $this->hasMany(project::class,'category_id','id');
    }
    public function children()
    {
        return $this->hasMany(category::class,'parent_id','id');
    }
    public function parent()
    {
        return $this->belongsTo(category::class,'parent_id','id')->withDefault([
            'name'=>'no parent'
        ]);
    }

}
