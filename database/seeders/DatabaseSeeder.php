<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Akun ADMIN
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@lms.com',
            'password' => bcrypt('password'), // passwordnya: password
            'role' => 'admin',
        ]);

        // 2. Buat Akun INSTRUCTOR (GURU)
        User::create([
            'name' => 'Mr. Guru Bahasa',
            'email' => 'guru@lms.com',
            'password' => bcrypt('password'),
            'role' => 'instructor',
            'bio' => 'Ahli bahasa berpengalaman 10 tahun.'
        ]);

        // 3. Buat Akun STUDENT (SISWA)
        User::create([
            'name' => 'Siswa Rajin',
            'email' => 'siswa@lms.com',
            'password' => bcrypt('password'),
            'role' => 'student',
        ]);

        // 4. Buat Kategori Bahasa
        Category::create(['name' => 'Bahasa Inggris', 'slug' => 'bahasa-inggris']);
        Category::create(['name' => 'Bahasa Jepang', 'slug' => 'bahasa-jepang']);
        Category::create(['name' => 'Bahasa Korea', 'slug' => 'bahasa-korea']);
        Category::create(['name' => 'Bahasa Jerman', 'slug' => 'bahasa-jerman']);
    }
}
