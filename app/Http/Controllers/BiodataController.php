<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BiodataRequest;
use App\Models\Category;
use App\Models\Course;
use App\Models\Notification;

class BiodataController extends Controller
{
    public function show()
    {
        $categories = Category::with('courses')->where('name', 'like', '%bahasa%')->get();
        return view('biodata', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:biodata_requests,email',
            'selected_courses' => 'required|array|min:1|max:2',
            'selected_courses.*' => 'exists:courses,id',
        ]);

        BiodataRequest::create([
            'name' => $request->name,
            'email' => $request->email,
            'selected_courses' => $request->selected_courses,
        ]);

        // Notify admin
        Notification::create([
            'user_id' => 1, // Assuming admin is user 1, adjust as needed
            'message' => 'New biodata request from ' . $request->name,
            'type' => 'biodata_request',
        ]);

        return redirect('/')->with('success', 'Biodata request submitted successfully. Admin will review it.');
    }
}
