<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $fillable = [
        'name',
        'email',
        'subject',
        'message'
    ];

    public static $rules = [
        'name' => 'required|min:3|max:50',
        'email' => 'required',
        'subject' => 'required|min:3|max:50',
        'message' => 'required',
    ];
}
