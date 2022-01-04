<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'slug',
        'image'
    ];

    public static $rules = [
        'name' => 'required|min:3|max:100',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id');
    }
}
