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
use App\Http\Controllers\Admin\TaskController; // Pastikan ini ada

// --- HALAMAN PUBLIC ---
Route::get('/', function () { return redirect()->route('login'); });

// --- AUTHENTICATION ---
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// --- GROUP ADMIN ---
// Prefix URL: /admin/... | Prefix Name: admin.
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('categories', CategoryController::class);
    Route::resource('users', UserController::class);
    Route::resource('courses', CourseController::class);
    Route::get('/bookings', [App\Http\Controllers\Admin\BookingController::class, 'index'])->name('bookings.index');
    Route::post('/bookings/{booking}/confirm', [App\Http\Controllers\Admin\BookingController::class, 'confirm'])->name('bookings.confirm');
    Route::get('/instructor/{id}/give-task', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/instructor/{id}/give-task', [TaskController::class, 'store'])->name('tasks.store');
});

// --- GROUP INSTRUCTOR ---
Route::middleware(['auth', 'role:instructor'])->prefix('instructor')->name('instructor.')->group(function () {
    Route::get('/dashboard', [InstructorDashboard::class, 'index'])->name('dashboard');
    Route::resource('courses', InstructorCourse::class);

    // Daftar Siswa
    Route::get('/students', [App\Http\Controllers\Instructor\StudentController::class, 'index'])->name('students.index');

    // Route untuk baca tugas (Lebih aman ditaruh di dalam middleware auth/instructor)
    Route::post('/task/{id}/read', [TaskController::class, 'markAsRead'])->name('tasks.read');
});

// --- GROUP STUDENT ---
Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentDashboard::class, 'index'])->name('dashboard');
    Route::get('/courses', [StudentDashboard::class, 'courses'])->name('courses');
    Route::get('/browse-courses', [StudentDashboard::class, 'browseCourses'])->name('browse-courses');
    Route::post('/enroll/{course}', [StudentDashboard::class, 'enroll'])->name('enroll');
    Route::get('/certificates', [StudentDashboard::class, 'certificates'])->name('certificates');
});

// --- PROFILE ---
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
