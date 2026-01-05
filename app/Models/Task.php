<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // Izinkan kolom ini diisi
    protected $fillable = [
        'user_id',
        'admin_id',
        'title',
        'description',
        'is_read'
    ];

    // Relasi ke User (Instruktur)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke User (Admin)
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
