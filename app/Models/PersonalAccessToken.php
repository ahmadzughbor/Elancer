<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;

class PersonalAccessToken extends SanctumPersonalAccessToken
{
    use HasFactory;
    //protected $hidden = [];
    protected $fillable = [
        'name',
        'token',
        'abilities',
        'fcm_token',
        'ip_address'
    ];
}
