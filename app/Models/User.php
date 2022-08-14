<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\NewAccessToken;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function freelancer()
    {
        return $this->hasOne(freelancer::class, 'user_id', 'id')->withDefault();
    }

    public function projects()
    {
        return $this->hasMany(project::class, 'user_id', 'id');
    }

    public function proposals()
    {
        return $this->hasMany(Proposal::class, 'freelancer_id', 'id');
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class, 'freelancer_id', 'id');
    }
    public function proposedProjects()
    {
        return $this->belongsToMany(
            project::class,
            'proposals',
            'freelancer_id',
            'project_id'
        )->withPivot(['description', 'cost', 'duration', 'duration_unit', 'status']);
    }
    public function contactedProjects()
    {
        return $this->belongsToMany(
            project::class,
            'proposals',
            'freelancer_id',
            'project_id'
        )->withPivot([
            'cost', 'type', 'status', 'start_on', 'end_on', 'completed_on', 'hours'
        ]);
    }
    public function getProfilePhotoUrlAttribute()
    {
        if ($this->freelancer->profile_photo_path) {
            return asset('storage/' . $this->freelancer->profile_photo_path);
        }
        return asset('images/default.png');
    }
    public function routeNotificationForMail($notification = null)
    {
        return $this->email;
    }
    public function routeNotificationForNexmo($notification = null)
    {
        return  $this->mobile_number;
    }
    // public function receivesBroadcastNotificationsOn ()
    // {
    //     return 'Notifications.'.$this->id;
    // }
    /**
     * Create a new personal access token for the user.
     *
     * @param  string  $name
     * @param  array  $abilities
     * @return \Laravel\Sanctum\NewAccessToken
     */
    public function createToken(string $name, array $abilities = ['*'], $fcm_token = null)
    {
        $token = $this->tokens()->create([
            'name' => $name,
            'token' => hash('sha256', $plainTextToken = Str::random(40)),
            'abilities' => $abilities,
            'fcm_token' => $fcm_token,
        ]);

        return new NewAccessToken($token, $token->getKey() . '|' . $plainTextToken);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    public function HasAbility($ability)
    {
        foreach ($this->roles as $role) {
            if (in_array($ability, $role->abilities)) {
                return true;
            }
        }
        return  false;
    }
}
