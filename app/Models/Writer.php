<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Writer extends Authenticatable
{
    use HasFactory;

    protected $guard = 'writer';

    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'avatar'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
