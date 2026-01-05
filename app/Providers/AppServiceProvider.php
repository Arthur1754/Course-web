<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Mengirim data notifikasi ke file 'header' milik instruktur
        // Pastikan nama view-nya sesuai folder Anda: 'layouts.instructor.header' atau 'instructor.header'
        // Tanda '*' artinya data dikirim ke SEMUA tampilan (paling aman)
        View::composer('*', function ($view) {
            $unreadTasks = collect(); // Default kosong

            if (Auth::check() && Auth::user()->role == 'instructor') {
                $unreadTasks = Task::where('user_id', Auth::id())
                                    ->where('is_read', false)
                                    ->latest()
                                    ->get();
            }

            $view->with('unreadTasks', $unreadTasks);
        });
    }
}
