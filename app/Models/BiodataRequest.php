<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BiodataRequest extends Model
{
    protected $fillable = [
        'name',
        'email',
        'selected_courses',
    ];

    protected $casts = [
        'selected_courses' => 'array',
    ];
}
