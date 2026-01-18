<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',   // admin, instructor, student
        'avatar', // foto profil (opsional)
        'bio',    // biografi singkat (opsional)
        'taught_categories', // kategori yang diajar instruktur
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Helper untuk mengecek Role
    public function hasRole($role)
    {
        return $this->role === $role;
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_user')
                    ->withPivot('progress', 'status')
                    ->withTimestamps();
    }

        public function tasks()
        {
        // 'user_id' adalah foreign key di tabel tasks yang menunjuk ke instruktur
        return $this->hasMany(Task::class, 'user_id');
        }
}
