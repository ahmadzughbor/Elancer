<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Contract extends Model
{
    use HasFactory,Notifiable;
    protected  $fillable = [
        'freelancer_id','project_id','proposal_id','cost','type','status','start_on','end_on','completed_on','hours',
    ];
    protected $casts = [
        'start_on' => 'datetime',
        'end_on' => 'datetime',
        'completed_on' => 'datetime',

    ];
    public function freelancer()
    {
        return $this->belongsTo(user::class,'freelancer_id','id');
    }
    public function project()
    {
        return $this->belongsTo(project::class,'project_id','id');
    }
    public function proposal()
    {
        return $this->belongsTo(Proposal::class,'proposal_id','id')->withDefault();
    }
}
