<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;

class DashboardController extends Controller
{
    public function index()
{
    // 1. Ambil ID user yang sedang login (si instruktur)
    $userId = Auth::id();

    // 2. Ambil data kursus milik instruktur tersebut
    $myCourses = Course::where('user_id', $userId)->get();

    // 3. Hitung total kursus
    $totalCourses = Course::where('user_id', $userId)->count();

    // 4. Hitung total siswa unik yang terdaftar di kursus instruktur
    $courseIds = Course::where('user_id', $userId)->pluck('id');
    $totalStudents = \DB::table('course_student')
        ->whereIn('course_id', $courseIds)
        ->distinct('user_id')
        ->count('user_id');

    // 5. Kirim variabel ke view
    return view('instructor.dashboard', compact('myCourses', 'totalCourses', 'totalStudents'));
}
}
