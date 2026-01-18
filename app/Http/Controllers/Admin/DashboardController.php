<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

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

        // 3. Ambil 5 kursus pending terbaru (UNTUK TABEL, BUKAN BOOKING)
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
            'recentPendingCourses'
        ));
    }
}
