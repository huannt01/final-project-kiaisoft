<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    const ERR_LOGIN_FAILED = 'E1008';
    const ERR_LOGIN_BLOCK = 'E1009';
    const ERR_LOGIN_VERIFIED_EMAIL = 'E1010';
    const ERR_UNAUTHENTICATED = 'E1011';
    const ERR_TOKEN_INVALID_EXCEPTION = 'E1012';
    const ERR_INTERNAL_SERVER_ERROR = 'E1022';
    const ERR_USER_DOES_NOT_EXIST = 'E1023';
    const ERROR_CHANGE_PASSWORD = 'E1024';
    const ERR_LOGIN_DEACTIVATED = 'E1025';
    const ERR_INPUT_INVALID = 'E1026';

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

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
