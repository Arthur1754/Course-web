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
        $myCourses = Auth::user()->courses()->with('instructor')->withPivot('progress')->get();

        // Hitung kursus yang sedang dipelajari (progress < 100)
        $inProgressCourses = $myCourses->where('pivot.progress', '<', 100)->count();

        // Hitung kursus yang sudah selesai (progress == 100)
        $completedCourses = $myCourses->where('pivot.progress', '=', 100)->count();

        return view('student.dashboard', compact('myCourses', 'inProgressCourses', 'completedCourses'));
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

        // 2. Ambil Modul dan Materi (Lessons)
        // Kita load eager loading agar query ringan
        $course->load(['modules.lessons', 'instructor']);

        // 3. Tentukan materi mana yang aktif (Default: Materi pertama dari Modul pertama)
        $currentLesson = null;

        // Cek apakah kursus memiliki module dan lesson
        if ($course->modules->isNotEmpty() && $course->modules->first()->lessons->isNotEmpty()) {
            $currentLesson = $course->modules->first()->lessons->first();
        }

        return view('student.course.learn', compact('course', 'currentLesson'));
    }

    // Halaman Kursus Saya
    public function courses()
    {
        $myCourses = Auth::user()->courses()->with('instructor')->withPivot('progress')->get();

        return view('student.courses', compact('myCourses'));
    }

    // Halaman Browse Kursus (Semua kursus yang tersedia)
    public function browseCourses()
    {
        $courses = Course::with(['instructor', 'category'])->where('status', 'published')->get();

        return view('student.browse-courses', compact('courses'));
    }

    // Enroll ke kursus
    public function enroll(Course $course)
    {
        $user = Auth::user();

        // Cek apakah sudah terdaftar
        if ($user->courses->contains($course->id)) {
            return redirect()->back()->with('error', 'Anda sudah terdaftar di kursus ini.');
        }

        // Daftarkan siswa ke kursus dengan progress 0
        $user->courses()->attach($course->id, ['progress' => 0]);

        return redirect()->route('student.courses')->with('success', 'Berhasil mendaftar ke kursus!');
    }

    // Halaman Sertifikat
    public function certificates()
    {
        // Ambil kursus yang sudah selesai (progress 100%)
        $completedCourses = Auth::user()->courses()->with('instructor')->wherePivot('progress', 100)->get();

        return view('student.certificates', compact('completedCourses'));
    }
}
