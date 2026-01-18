<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Untuk enkripsi password
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // 1. INDEX: Tampilkan daftar user
    public function index()
    {
        // Ambil data user terbaru, paginate 10
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    // 2. CREATE: Form tambah user
    public function create()
    {
        $categories = Category::all();
        return view('admin.users.create', compact('categories'));
    }

    // 3. STORE: Simpan user baru
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role'     => 'required|in:admin,instructor,student',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password), // Password wajib di-hash!
            'role'     => $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan!');
    }

    // 4. EDIT: Form edit user
    public function edit(User $user)
    {
        $categories = Category::all();
        return view('admin.users.edit', compact('user', 'categories'));
    }

    // 5. UPDATE: Update data user
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            // Validasi email unik kecuali punya diri sendiri
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'role'  => 'required|in:admin,instructor,student',
            // Password boleh kosong jika tidak ingin diganti
            'password' => 'nullable|min:6',
        ]);

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role,
        ];

        // Jika password diisi, update password baru
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui!');
    }

    // 6. DESTROY: Hapus user
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus!');
    }
}
