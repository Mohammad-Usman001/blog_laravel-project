<?php

namespace App\Models;
use App\Models\Blogpost;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable =[
        'post_id',
        'guest_name',
        'guest_email',
        'comment',
        'is_active',
    ];

    public function post()
    {
        return $this->belongsTo(Blogpost::class, 'post_id');
    }

    public function scopeApproved($query)
    {
        return $query->where('is_active', true);
    }
}
