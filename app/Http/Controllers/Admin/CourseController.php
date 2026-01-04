<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    // 1. DAFTAR KURSUS (Disini Admin melihat request dari guru)
    public function index()
    {
        // Ambil kursus beserta data Kategori dan Instruktur-nya (Eager Loading)
        $courses = Course::with(['category', 'instructor'])->latest()->paginate(10);
        return view('admin.courses.index', compact('courses'));
    }

    // 2. FORM TAMBAH (Admin juga boleh buat kursus sendiri)
    public function create()
    {
        $categories = Category::all();
        // Hanya ambil user yang role-nya 'instructor'
        $instructors = User::where('role', 'instructor')->get();

        return view('admin.courses.create', compact('categories', 'instructors'));
    }

    // 3. SIMPAN KURSUS
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'user_id'     => 'required|exists:users,id', // Instruktur wajib dipilih
            'thumbnail'   => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'required',
            'price'       => 'required|integer|min:0',
        ]);

        $data = [
            'name'         => $request->name,
            'slug'         => Str::slug($request->name),
            'category_id'  => $request->category_id,
            'user_id'      => $request->user_id,
            'description'  => $request->description,
            'price'        => $request->price,
            'status' => $request->has('is_published') ? 'published' : 'draft',
        ];

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        Course::create($data);

        return redirect()->route('admin.courses.index')->with('success', 'Kursus berhasil dibuat!');
    }

    // 4. FORM EDIT (Admin bisa edit/approve kursus)
    public function edit(Course $course)
    {
        $categories = Category::all();
        $instructors = User::where('role', 'instructor')->get();
        return view('admin.courses.edit', compact('course', 'categories', 'instructors'));
    }

    // 5. UPDATE (Termasuk Approve/Publish)
    public function update(Request $request, Course $course)
    {
        // Ambil value dari tombol yang diklik (approve atau reject)
        $action = $request->input('action');

        if ($action == 'approve') {
            // Jika disetujui, ubah status jadi PUBLISHED
            $course->update(['status' => 'published']);
            $message = 'Kursus berhasil DISETUJUI.';

        } elseif ($action == 'reject') {
            // Jika ditolak, ubah status jadi REJECTED (Bukan Draft lagi)
            $course->update(['status' => 'rejected']);
            $message = 'Kursus telah DITOLAK. Status berubah menjadi Rejected.';

        } else {
            // Jaga-jaga jika ada input aneh
            return redirect()->back()->with('error', 'Aksi tidak valid.');
        }

        return redirect()->route('admin.courses.index')->with('success', $message);
    }

    // 6. HAPUS
    public function destroy(Course $course)
    {
        if ($course->thumbnail && Storage::disk('public')->exists($course->thumbnail)) {
            Storage::disk('public')->delete($course->thumbnail);
        }
        $course->delete();
        return redirect()->route('admin.courses.index')->with('success', 'Kursus dihapus!');
    }
}
