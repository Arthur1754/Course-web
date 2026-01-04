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

    // 3. Kirim variabel $myCourses ke view
    return view('instructor.dashboard', compact('myCourses'));
}
}
