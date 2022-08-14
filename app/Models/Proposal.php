<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Proposal extends Model
{
    use HasFactory,Notifiable;
    protected  $fillable = [
        'freelancer_id','project_id','description','cost','duration','duration_type','status'
    ];
    public function freelancer()
    {
        return $this->belongsTo(user::class,'freelancer_id','id');
    }
    public function project()
    {
        return $this->belongsTo(project::class,'project_id','id');
    }
    public function contract()
    {
        return $this->hasOne(contract::class,'proposal_id','id')->withDefault();
    }
    public static function units(){
        return [
            'day'=>'Day',
            'month'=>'Month',
            'week'=>'Week',
            'year'=>'Year',
        ];
    }
}
