<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // AMBIL DATA DARI DATABASE
        // Kita ambil kursus milik user, beserta data instruktur-nya (agar tidak error saat menampilkan nama guru)
        $myCourses = $user->courses()->with('instructor')->get();

        // Hitung statistik sederhana untuk widget atas
        $totalCourses = $myCourses->count();
        $completedCourses = $myCourses->where('pivot.progress', 100)->count();
        $inProgressCourses = $totalCourses - $completedCourses;

        return view('student.dashboard', compact('user', 'myCourses', 'totalCourses', 'completedCourses', 'inProgressCourses'));
    }
}