<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Cek apakah user sudah login?
        // Jika belum, lempar kembali ke halaman login
        if (!Auth::check()) {
            return redirect('login');
        }

        // 2. Ambil role user yang sedang login
        $userRole = Auth::user()->role;

        // 3. Cek apakah role user ada di daftar yang diizinkan
        // Parameter ...$roles akan menangkap argumen dari route (misal: 'admin', 'instructor')
        if (in_array($userRole, $roles)) {
            // Jika role cocok, silakan lanjut
            return $next($request);
        }

        // 4. Jika role TIDAK cocok, tampilkan pesan Error 403 (Forbidden)
        abort(403, 'Akses Ditolak! Anda tidak memiliki izin untuk mengakses halaman ini.');
    }
}
