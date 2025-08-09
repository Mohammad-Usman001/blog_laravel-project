<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlogPost extends Model
{
    protected $table = 'blogposts';
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'short_description',
        'meta_title',
        'meta_description',
        'content',
        'image',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }
    public function approvedComments()
    {
        return $this->hasMany(Comment::class, 'post_id')->where('is_active', true)->latest();
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'post_id');
    }
    
}
