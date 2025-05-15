<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookingAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = \App\Models\Booking::with(['user', 'showtime.movie', 'seats.room']);
        if ($request->filled('email')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('email', 'like', '%' . $request->email . '%');
            });
        }
        $bookings = $query->paginate(10);
        return view('admin.bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = \App\Models\User::all();
        $showtimes = \App\Models\Showtime::with('movie')->get();
        $seats = \App\Models\Seat::with('room')->get();
        return view('admin.bookings.create', compact('users', 'showtimes', 'seats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'showtime_id' => 'required|exists:showtimes,id',
            'seat_id' => 'required|exists:seats,id',
            'status' => 'required|in:paid,unpaid',
        ]);
        \App\Models\Booking::create($data);
        return redirect()->route('admin.bookings.index')->with('success', 'Thêm đặt vé thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $booking = \App\Models\Booking::with(['showtime.movie', 'showtime.room', 'seats'])->findOrFail($id);
        return view('admin.bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $booking = \App\Models\Booking::findOrFail($id);
        $users = \App\Models\User::all();
        $showtimes = \App\Models\Showtime::with('movie')->get();
        $seats = \App\Models\Seat::with('room')->get();
        return view('admin.bookings.edit', compact('booking', 'users', 'showtimes', 'seats'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $booking = \App\Models\Booking::findOrFail($id);
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'showtime_id' => 'required|exists:showtimes,id',
            'seat_id' => 'required|exists:seats,id',
            'status' => 'required|in:paid,unpaid',
        ]);
        $booking->update($data);
        return redirect()->route('admin.bookings.index')->with('success', 'Cập nhật đặt vé thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $booking = \App\Models\Booking::findOrFail($id);
        $booking->delete();
        return redirect()->route('admin.bookings.index')->with('success', 'Xóa đặt vé thành công!');
    }

    /**
     * Confirm payment for a booking
     */
    public function confirmPayment($id)
    {
        $booking = \App\Models\Booking::findOrFail($id);
        $booking->status = 'paid';
        $booking->save();
        return redirect()->route('admin.bookings.index')->with('success', 'Xác nhận thanh toán thành công!');
    }
}
