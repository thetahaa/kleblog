<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
        'image',
        'status',
        'publish_at',
        'expire_at',
    ];

    protected $dates = [
        'publish_at',
        'expire_at'
    ];

    protected $casts = [
        'publish_at' => 'datetime',
        'expire_at' => 'datetime',
    ];

    public function scopePublished($query)
    {
        return $query->where('status', true)
            ->where(function($q) {
                $q->where('publish_at', '<=', now())
                ->orWhereNull('publish_at');
            })
            ->where(function($q) {
                $q->where('expire_at', '>', now())
                ->orWhereNull('expire_at');
            });
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function scopePopular($query)
    {
        return $query->withCount(['comments' => function ($query) {
                    $query->where('status', true);
                }])
            ->orderBy('comments_count', 'desc');
    }

}