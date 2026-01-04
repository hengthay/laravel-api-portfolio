<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Educations extends Model
{
    protected $fillable = ['institution', 'degree', 'field', 'start_date', 'end_date'];
}
