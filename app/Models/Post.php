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

    public function categories ()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
