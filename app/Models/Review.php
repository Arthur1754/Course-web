<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'user_id', 'rating', 'comment'];

    // Relasi: Review milik 1 Kursus
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Relasi: Review ditulis oleh 1 User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
