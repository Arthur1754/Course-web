<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Hitung Statistik Utama
        // Asumsi: Anda membedakan user berdasarkan kolom 'role' ('student' / 'instructor')
        $totalStudents = User::where('role', 'student')->count();
        $totalInstructors = User::where('role', 'instructor')->count();
        $totalCourses = Course::count();
        $totalCategories = Category::count();

        // 2. Hitung Kursus yang statusnya 'pending' (Menunggu Review)
        // Ini variabel yang tadi bikin error karena belum dikirim
        $pendingCourses = Course::where('status', 'pending')->count();

        // 3. Ambil 5 data kursus pending terbaru untuk tabel mini
        $recentPendingCourses = Course::where('status', 'pending')
                                    ->with(['instructor', 'category'])
                                    ->latest()
                                    ->take(5)
                                    ->get();

        // 4. Kirim semua data ke View dashboard
        return view('admin.dashboard', compact(
            'totalStudents',
            'totalInstructors',
            'totalCourses',
            'totalCategories',
            'pendingCourses',
            'recentPendingCourses'
        ));
    }

    // Tambahkan method ini di bawah method index
    public function learn(Course $course)
    {
        // 1. Validasi: Pastikan siswa benar-benar terdaftar di kursus ini
        $user = Auth::user();
        if (!$user->courses->contains($course->id)) {
            abort(403, 'Anda belum terdaftar di kursus ini.');
        }

        // 2. Ambil Bab (Chapters) dan Materi (Lessons)
        // Pastikan Anda sudah membuat relasi di model Course, Chapter, dan Lesson
        // Struktur: Course -> hasMany Chapters -> hasMany Lessons
        $course->load(['chapters.lessons', 'instructor']);

        // 3. Tentukan materi mana yang aktif (Default: Materi pertama dari Bab pertama)
        // Nanti bisa dikembangkan untuk membuka materi terakhir yang ditonton
        $currentLesson = $course->chapters->first()->lessons->first();

        return view('student.course.learn', compact('course', 'currentLesson'));
    }
}
