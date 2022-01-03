<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutMe extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'short_description',
        'image',
        'content'
    ];

    public static $rules = [
        'name' => 'required|min:3',
        'short_description' => 'required|min:20',
        'content' => 'required|min:50'
    ];
}
