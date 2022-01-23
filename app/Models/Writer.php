<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Writer extends Model
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
