<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $fillable = [
        'title',
        'slug',
        'thumbnail',
        'category_id',
        'content',
        'status'
    ];

    public static $rules = [
        'title' => 'required|min:3|max:100',
        'category_id' => 'required',
        'thumbnail' => 'required',
        'content' => 'required'
    ];

    public function categories ()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
