<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Category extends Model
{
    protected $fillable = [
        'name'
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($categories) {
            $categories->slug = Str::slug($categories->name);
        });
    }
}
