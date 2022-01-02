<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $fillable = [
        'title',
        'image',
        'url',
        'order_',
        'status'
    ];

    public static $rules = [
        'title' => 'required|min:3',
        'image' => 'required',
    ];
}
