<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage; // Penting untuk hapus file

class CategoryController extends Controller
{
    // 1. READ: Tampilkan daftar kategori
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    // 2. CREATE: Tampilkan form tambah
    public function create()
    {
        return view('admin.categories.create');
    }

    // 3. STORE: Simpan data baru ke database
    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'name'  => 'required|unique:categories,name|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Maks 2MB
        ]);

        // 2. Persiapan Data Dasar
        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ];

        // 3. Cek & Simpan Gambar
        if ($request->hasFile('image')) {
            // Simpan ke folder: storage/app/public/categories
            $imagePath = $request->file('image')->store('categories', 'public');
            $data['image'] = $imagePath;
        }

        Category::create($data);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    // 4. EDIT: Tampilkan form edit
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    // 5. UPDATE: Simpan perubahan
    public function update(Request $request, Category $category)
    {
        // 1. Validasi
        $request->validate([
            'name'  => 'required|max:50|unique:categories,name,' . $category->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 2. Persiapan Data Dasar
        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ];

        // 3. Cek Gambar Baru
        if ($request->hasFile('image')) {

            // Hapus gambar lama jika ada
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }

            // Simpan gambar baru
            $imagePath = $request->file('image')->store('categories', 'public');
            $data['image'] = $imagePath;
        }

        // 4. Update Database
        $category->update($data);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    // 6. DELETE: Hapus data
    public function destroy(Category $category)
    {
        // 1. Hapus file gambar fisik jika ada
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        // 2. Hapus data di database
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Kategori dan gambarnya berhasil dihapus!');
    }
}
