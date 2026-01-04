<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::where('user_id', Auth::id())
                        ->with('category')
                        ->latest()
                        ->paginate(10);

        return view('instructor.courses.index', compact('courses'));
    }

    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('instructor.courses.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'thumbnail'   => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'required',
            'price'       => 'required|integer|min:0',
        ]);

        $data = [
            'name'         => $request->name,
            'slug'         => \Illuminate\Support\Str::slug($request->name),
            'category_id'  => $request->category_id,
            'user_id'      => Auth::id(),
            'description'  => $request->description,
            'price'        => $request->price,
            'status'       => 'draft', // Default to draft for instructors
        ];

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        Course::create($data);

        return redirect()->route('instructor.courses.index')->with('success', 'Kursus berhasil dibuat! Status masih Draft.');
    }

    public function edit(Course $course)
    {
        // Ensure instructor owns the course
        if ($course->user_id != Auth::id()) {
            abort(403);
        }

        $categories = \App\Models\Category::all();
        return view('instructor.courses.edit', compact('course', 'categories'));
    }

    public function update(Request $request, Course $course)
    {
        if ($course->user_id != Auth::id()) {
            abort(403);
        }

        $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'thumbnail'   => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'required',
            'price'       => 'required|integer|min:0',
        ]);

        $data = [
            'name'         => $request->name,
            'slug'         => \Illuminate\Support\Str::slug($request->name),
            'category_id'  => $request->category_id,
            'description'  => $request->description,
            'price'        => $request->price,
        ];

        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail
            if ($course->thumbnail && \Illuminate\Support\Facades\Storage::disk('public')->exists($course->thumbnail)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($course->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }
        
        // If instructor makes changes, maybe reset to draft or keep current status?
        // For now, let's keep status unless they explicitly submit for review (which we can add later).
        // Or if it was rejected, maybe move back to draft?
        if($course->status == 'rejected') {
            $data['status'] = 'draft';
        }

        $course->update($data);

        return redirect()->route('instructor.courses.index')->with('success', 'Kursus berhasil diperbarui!');
    }

    public function destroy(Course $course)
    {
        if ($course->user_id != Auth::id()) {
            abort(403);
        }

        if ($course->thumbnail && \Illuminate\Support\Facades\Storage::disk('public')->exists($course->thumbnail)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($course->thumbnail);
        }
        $course->delete();

        return redirect()->route('instructor.courses.index')->with('success', 'Kursus berhasil dihapus!');
    }
}
