<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guard = 'admin';

    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'image'
    ];

    public static $rules = [
        'name' => 'required|min:3',
        'email' => 'required|unique:users',
        'username' => 'required|min:5|unique:users',
        'password' => 'required|min:8' 
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

  
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];
}
