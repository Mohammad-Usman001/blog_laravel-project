<?php

namespace App\Models;

use App\Models\BlogPost;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    public function blogs()
    {
        return $this->hasMany(BlogPost::class);
    }
}
