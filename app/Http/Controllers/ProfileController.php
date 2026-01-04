<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // Menampilkan Halaman Profil
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    // Memproses Update Profil
    public function update(Request $request)
    {
        $user = Auth::user();

        // 1. Validasi Input (Agar data yang masuk aman)
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Maksimal 2MB
            'password' => 'nullable|min:6|confirmed', // Harus cocok dengan password_confirmation
        ]);

        // 2. Update Data Dasar (Nama & Email)
        $user->name = $request->name;
        $user->email = $request->email;

        // 3. Cek apakah ada upload Foto Baru?
        if ($request->hasFile('avatar')) {
            // Hapus foto lama jika ada (dan bukan foto default)
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Simpan foto baru ke folder 'avatars' di storage public
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }

        // 4. Cek apakah user ingin ganti Password?
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // 5. EKSEKUSI SIMPAN KE DATABASE
        $user->save();

        // 6. Kembali ke halaman profil dengan pesan sukses
        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}