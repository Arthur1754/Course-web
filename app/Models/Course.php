<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'slug',
        'thumbnail',
        'description',
        'content',
        'price',
        'status',
    ];

    // Relasi: Kursus dimiliki oleh 1 Kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi: Kursus dimiliki oleh 1 Instruktur (User)
    public function instructor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi: Kursus memiliki banyak Siswa
    public function students()
    {
        return $this->belongsToMany(User::class, 'course_student', 'course_id', 'user_id')
                    ->withPivot('status', 'progress')
                    ->withTimestamps();
    }

    // Relasi: Kursus memiliki banyak Modul
    public function modules()
    {
        return $this->hasMany(Module::class)->orderBy('sort_order', 'asc');
    }
}
