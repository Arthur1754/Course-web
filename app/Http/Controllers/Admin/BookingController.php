<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        // Ambil semua booking dengan status pending
        $pendingBookings = User::with(['courses' => function($query) {
            $query->wherePivot('status', 'pending');
        }])->whereHas('courses', function($query) {
            $query->wherePivot('status', 'pending');
        })->get();

        return view('admin.bookings.index', compact('pendingBookings'));
    }

    public function confirm(Request $request, $booking)
    {
        // Parse booking ID (format: user_id-course_id)
        [$userId, $courseId] = explode('-', $booking);

        $user = User::findOrFail($userId);
        $user->courses()->updateExistingPivot($courseId, ['status' => 'active']);

        return redirect()->back()->with('success', 'Booking berhasil dikonfirmasi.');
    }
}
