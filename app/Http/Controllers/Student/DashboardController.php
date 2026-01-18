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
        $user = Auth::user();

        // 1. KURSUS SAYA
        // Update: Saya tambah 'category' agar badge kategori muncul di view
        $myCourses = $user->courses()->with(['instructor', 'category'])->withPivot('progress')->get();

        // Hitung statistik (Opsional, tetap dibiarkan ada)
        $inProgressCourses = $myCourses->where('pivot.progress', '<', 100)->count();
        $completedCourses = $myCourses->where('pivot.progress', '=', 100)->count();

        // 2. REKOMENDASI KURSUS (YANG BELUM DIAMBIL)
        // Logic: Ambil semua course 'published', kecuali ID yang sudah ada di $myCourses
        $otherCourses = Course::with(['instructor', 'category'])
            ->where('status', 'published')
            ->whereNotIn('id', $myCourses->pluck('id')) // Kecualikan yg sudah dibeli
            ->latest() // Urutkan dari yang terbaru
            ->take(4)  // Batasi hanya 4 kursus agar rapi di dashboard
            ->get();

        // Kirim $otherCourses ke view
        return view('student.dashboard', compact('myCourses', 'inProgressCourses', 'completedCourses', 'otherCourses'));
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

    // Halaman Kursus Saya (List Lengkap)
// Halaman Kursus Saya (List Lengkap)
    public function courses()
    {
        $user = Auth::user();

        // 1. Ambil Kursus Saya
        $myCourses = $user->courses()->with(['instructor', 'category'])->withPivot('progress')->get();

        // 2. TAMBAHAN: Ambil Rekomendasi (Kursus lain yang belum dibeli)
        // Bagian ini wajib ada karena view 'student.courses' membutuhkannya ($otherCourses)
        $otherCourses = Course::with(['instructor', 'category'])
            ->where('status', 'published')
            ->whereNotIn('id', $myCourses->pluck('id'))
            ->latest()
            ->take(4)
            ->get();

        return view('student.courses', compact('myCourses', 'otherCourses'));
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
        $completedCourses = Auth::user()->courses()->with(['instructor', 'category'])->wherePivot('progress', 100)->get();

        return view('student.certificates', compact('completedCourses'));
    }
}
