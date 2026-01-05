<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // Halaman Dashboard Utama Siswa
    public function index()
    {
        // Menampilkan kursus yang sedang diikuti oleh siswa
        $myCourses = Auth::user()->courses()->with('instructor')->get();

        return view('student.dashboard', compact('myCourses'));
    }

    // Halaman Belajar (Masuk ke materi)
    public function learn(Course $course)
    {
        // 1. Validasi: Pastikan siswa benar-benar terdaftar di kursus ini
        $user = Auth::user();

        // Cek relasi (Pastikan di Model User sudah ada relasi 'courses')
        if (!$user->courses->contains($course->id)) {
            abort(403, 'Anda belum terdaftar di kursus ini.');
        }

        // 2. Ambil Bab (Chapters) dan Materi (Lessons)
        // Kita load eager loading agar query ringan
        $course->load(['chapters.lessons', 'instructor']);

        // 3. Tentukan materi mana yang aktif (Default: Materi pertama dari Bab pertama)
        $currentLesson = null;

        // Cek apakah kursus memiliki chapter dan lesson
        if ($course->chapters->isNotEmpty() && $course->chapters->first()->lessons->isNotEmpty()) {
            $currentLesson = $course->chapters->first()->lessons->first();
        }

        return view('student.course.learn', compact('course', 'currentLesson'));
    }
}
