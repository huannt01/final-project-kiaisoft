<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    const ERR_LOGIN_FAILED = 'E1008';
    const ERR_LOGIN_BLOCK = 'E1009';
    const ERR_LOGIN_vERIFIED_EMAIL = 'E1010';
    const ERR_UNAUTHENTICATED = 'E1011';
    const ERR_TOKEN_INVALID_EXCEPTION = 'E1012';
    const ERR_INTERNAL_SERVER_ERROR = 'E1022';
    const ERR_USER_DOES_NOT_EXIST = 'E1023';
    const ERROR_CHANGE_PASSWORD = 'E1024';
    const ERR_LOGIN_DEACTIVATED = 'E1025';
    const ERR_INPUT_INVALID = 'E1026';
    const ERR_EMAIL_ALREADY_VERIFIED = 'E1027';

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
}
