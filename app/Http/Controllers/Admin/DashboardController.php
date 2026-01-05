<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Hitung User
        $totalStudents = User::where('role', 'student')->count();
        $totalInstructors = User::where('role', 'instructor')->count();

        // 2. Hitung Kursus & Kategori
        $totalCourses = Course::count();
        $totalCategories = Category::count();

        // 3. Kursus yang butuh review (misal status 'pending' adalah 0 atau 'pending')
        // Sesuaikan 'status' dengan nama kolom di database kamu
        $pendingCourses = Course::where('status', 'pending')->count();

        // 4. Ambil 5 kursus pending terbaru untuk tabel
        $recentPendingCourses = Course::with(['instructor', 'category'])
            ->where('status', 'pending')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalStudents',
            'totalInstructors',
            'totalCourses',
            'totalCategories',
            'pendingCourses',
            'recentPendingCourses'
        ));
    }
}
