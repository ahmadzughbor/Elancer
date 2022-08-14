<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class freelancer extends Model
{
    use HasFactory;
    protected $primaryKey = 'user_id';
    protected $fillable =[
        'first_name','last_name','description','gender','birthday','title','skills','country',
    ];
    protected $casts = [
        'birthday' => 'date'
    ];
    public function user()
    {
        return $this->belongsTo(user::class,'user_id','id');
    }
}
