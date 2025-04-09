<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Tag extends Model
{
    protected $fillable = [
        'name',
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($tags) {
            $tags->slug = Str::slug($tags->name);
        });
    }
}
