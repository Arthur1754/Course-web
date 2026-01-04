<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Instructor\DashboardController as InstructorDashboard;
use App\Http\Controllers\Instructor\CourseController as InstructorCourse;
use App\Http\Controllers\Student\DashboardController as StudentDashboard;
use App\Http\Controllers\ProfileController;

// --- HALAMAN PUBLIC ---
Route::get('/', function () { return redirect()->route('login'); });

// --- AUTHENTICATION ---
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- GROUP ADMIN ---
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('categories', CategoryController::class);
    Route::resource('users', UserController::class);
    Route::resource('courses', CourseController::class);
});

// --- GROUP INSTRUCTOR ---
Route::middleware(['auth', 'role:instructor'])->prefix('instructor')->name('instructor.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [InstructorDashboard::class, 'index'])->name('dashboard');

    // Manajemen Kursus
    Route::resource('courses', InstructorCourse::class);

    // Daftar Siswa 
    Route::get('/students', function() {
        return "Halaman Daftar Siswa (Controller belum dibuat)";
    })->name('students.index');

    // Jika Anda SUDAH punya StudentController, pakai baris di bawah ini dan hapus yang di atas:
    // Route::get('/students', [App\Http\Controllers\Instructor\StudentController::class, 'index'])->name('students.index');
});

// --- GROUP STUDENT (DIGABUNG JADI SATU AGAR RAPI) ---
Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentDashboard::class, 'index'])->name('dashboard');
    Route::get('/course/{course}/learn', [StudentDashboard::class, 'learn'])->name('course.learn');
});

// --- PROFILE ---
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
