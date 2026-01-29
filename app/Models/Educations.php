<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Educations extends Model
{
    protected $fillable = ['institution', 'degree', 'field', 'status', 'start_date', 'end_date'];
}
