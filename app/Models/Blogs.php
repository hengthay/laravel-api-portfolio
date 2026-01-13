<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    protected $fillable = ['title', 'content', 'slug', 'cover_image', 'published', 'tags', 'join_date'];

    // Casting data type to automatically, when saving JSON -> array, when reading array -> JSON
    protected $casts = [
        'tags' => 'array',
        'published' => 'boolean'
    ];
}
