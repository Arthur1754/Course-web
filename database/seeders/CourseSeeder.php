<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Support\Str;

class CourseSeeder extends Seeder
{
    public function run()
    {
        // 1. Buat Akun Instruktur Khusus Bahasa (Jika belum ada)
        $instructor = User::firstOrCreate(
            ['email' => 'guru-bahasa@lms.com'],
            [
                'name' => 'Sensei Budi',
                'password' => bcrypt('password'), // password login: password
                'role' => 'instructor',
                'email_verified_at' => now(),
            ]
        );

        // 2. Buat Kategori Bahasa
        $catInggris = Category::firstOrCreate(['slug' => 'bahasa-inggris'], ['name' => 'Bahasa Inggris']);
        $catJepang  = Category::firstOrCreate(['slug' => 'bahasa-jepang'], ['name' => 'Bahasa Jepang']);
        $catKorea   = Category::firstOrCreate(['slug' => 'bahasa-korea'], ['name' => 'Bahasa Korea']);
        $catArab    = Category::firstOrCreate(['slug' => 'bahasa-arab'], ['name' => 'Bahasa Arab']);
        $catMandarin = Category::firstOrCreate(['slug' => 'bahasa-mandarin'], ['name' => 'Bahasa Mandarin']);

        // 3. Daftar Ide Kursus Realistis
        // Format: [Nama Kategori Object, Judul Kursus, Harga (0 = gratis)]
        $courseList = [
            [$catInggris, 'Mastering 16 English Tenses', 150000],
            [$catInggris, 'TOEFL Preparation: Listening Section', 250000],
            [$catInggris, 'Speaking English like a Native', 0], // Gratis
            [$catInggris, 'Business English for Professionals', 300000],

            [$catJepang, 'Belajar Hiragana & Katakana dalam 24 Jam', 99000],
            [$catJepang, 'Persiapan JLPT N5 Lengkap', 200000],
            [$catJepang, 'Percakapan Bahasa Jepang untuk Turis', 0], // Gratis

            [$catKorea, 'Panduan Menulis Hangul (Korea) untuk Pemula', 0], // Gratis
            [$catKorea, 'EPS Topik Korea untuk Persiapan Kerja', 150000],
            [$catKorea, 'Drama Korean Vocabulary', 50000],

            [$catArab, 'Bahasa Arab Dasar (Nahwu & Shorof)', 100000],
            [$catArab, 'Percakapan Bahasa Arab Sehari-hari', 75000],

            [$catMandarin, 'Mandarin HSK 1 Preparation', 250000],
            [$catMandarin, '500 Hanzi Paling Sering Digunakan', 120000],
        ];

        // 4. Loop dan Masukkan ke Database
        foreach ($courseList as $data) {
            $category = $data[0];
            $title = $data[1];
            $price = $data[2];

            Course::create([
                'user_id' => $instructor->id,
                'category_id' => $category->id,
                'name' => $title,
                'slug' => Str::slug($title) . '-' . Str::random(5), // Tambah random string biar slug unik
                'thumbnail' => null,
                'description' => "Dalam kursus ini, Anda akan mempelajari materi $title secara mendalam mulai dari dasar hingga mahir. Cocok untuk pemula.",
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Materi lengkap video dan kuis ada di sini.',
                'price' => $price,
                'status' =>  fake()->randomElement(['draft', 'pending', 'published', 'rejected']),
            ]);
        }
    }
}
