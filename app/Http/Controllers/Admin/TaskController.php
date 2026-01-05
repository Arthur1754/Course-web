<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task; // Pastikan Model Task sudah ada sesuai langkah sebelumnya
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // 1. Menampilkan Form Beri Tugas
    public function create($userId)
    {
        $instructor = User::findOrFail($userId);

        // Validasi: Pastikan yang diberi tugas adalah Instructor
        if ($instructor->role !== 'instructor') {
            return redirect()->back()->with('error', 'User ini bukan instruktur!');
        }

        return view('admin.tasks.create', compact('instructor'));
    }

    // 2. Menyimpan Tugas ke Database
    public function store(Request $request, $userId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Simpan tugas
        $task = new Task();
        $task->user_id = $userId;     // ID Instruktur penerima
        $task->admin_id = Auth::id(); // ID Admin pengirim
        $task->title = $request->title;
        $task->description = $request->description;
        $task->is_read = false;
        $task->save();

        // REDIRECT KE DAFTAR USER (SUDAH BENAR MENGGUNAKAN .INDEX)
        return redirect()->route('admin.users.index')
            ->with('success', 'Tugas berhasil dikirim ke instruktur!');
    }

    // 3. Menandai Tugas Sudah Dibaca (Dipakai oleh Instruktur)
    public function markAsRead($id)
    {
        $task = Task::findOrFail($id);

        // Pastikan tugas ini milik user yang sedang login
        if ($task->user_id != Auth::id()) {
            abort(403);
        }

        $task->is_read = true;
        $task->save();

        return redirect()->back()->with('success', 'Notifikasi dihapus.');
    }
}
