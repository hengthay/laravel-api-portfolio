<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['name', 'email', 'introduce' ,'bio', 'hobbies', 'avatar_url', 'resume_url'];

    protected $casts = [
        'hobbies' => 'array'
    ];
}
