<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\User;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua kursus milik instruktur yang sedang login
        // dan load relasi students
        $instructorId = Auth::id();

        // Cara 1: Ambil students dari semua kursus (bisa duplikat jika siswa ambil >1 kursus)
        // Kita ingin menampilkan per pendaftaran (Student A di Course X)

        $courses = Course::with(['students' => function($query) {
            $query->orderBy('pivot_created_at', 'desc');
        }])
        ->where('user_id', $instructorId)
        ->get();

        // Kita bisa flat-kan data ini agar mudah ditampilkan di tabel
        // Atau kirim $courses ke view dan loop di sana (Nested: Course -> Students)

        return view('instructor.students.index', compact('courses'));
    }
}
