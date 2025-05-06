<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // API: Lấy ghế và trạng thái theo suất chiếu
    public function seatsByShowtime(Request $request) {
        $showtime_id = $request->query('showtime_id');
        $showtime = \App\Models\Showtime::with('room')->findOrFail($showtime_id);
        $room = $showtime->room;
        $seats = \App\Models\Seat::where('room_id', $room->id)->get();
        $booked = \App\Models\Booking::where('showtime_id', $showtime_id)->pluck('seat_id')->toArray();
        $seatArr = $seats->map(function($seat) use ($booked) {
            return [
                'id' => $seat->id,
                'seat_number' => $seat->seat_number,
                'type' => $seat->type,
                'price' => $seat->price,
                'booked' => in_array($seat->id, $booked)
            ];
        });
        return response()->json([
            'room' => $room->name,
            'seats' => $seatArr
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Booking::with(['showtime', 'seat', 'payment'])->get());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $movie_id = $request->query('movie_id');
        $movie = \App\Models\Movie::with('showtimes.room')->findOrFail($movie_id);
        // Lấy tất cả suất chiếu của phim
        $showtimes = $movie->showtimes()->with('room')->get();
        // Lấy tất cả phòng chiếu có suất chiếu cho phim này
        $rooms = $showtimes->pluck('room')->unique('id');
        // Lấy tất cả ghế của các phòng đó
        $room_ids = $rooms->pluck('id');
        $seats = \App\Models\Seat::whereIn('room_id', $room_ids)->get();
        return view('bookings.create', compact('movie', 'showtimes', 'rooms', 'seats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'showtime_id' => 'required|exists:showtimes,id',
            'seat_ids' => 'required|array|min:1',
            'seat_ids.*' => 'exists:seats,id',
            'customer_name' => 'required',
            'customer_phone' => 'required',
            'status' => 'required|in:unpaid,paid',
        ]);
        $created = [];
        foreach ($data['seat_ids'] as $seat_id) {
            // Kiểm tra ghế đã được đặt cho suất chiếu này chưa
            $exists = \App\Models\Booking::where('showtime_id', $data['showtime_id'])
                ->where('seat_id', $seat_id)
                ->exists();
            if (!$exists) {
                // Sinh mã vé tạm thởi, sau đó cập nhật lại với id
                $booking = \App\Models\Booking::create([
                    'user_id' => auth()->check() ? auth()->id() : null,
                    'showtime_id' => $data['showtime_id'],
                    'seat_id' => $seat_id,
                    'customer_name' => $data['customer_name'],
                    'customer_phone' => $data['customer_phone'],
                    'status' => $data['status'],
                    'ticket_code' => '',
                ]);
                $booking->ticket_code = 'VE' . date('Ymd') . str_pad($booking->id, 5, '0', STR_PAD_LEFT);
                $booking->save();
                $created[] = $booking;
            }
        }
        if (count($created)) {
            // Chuyển hướng tới trang chi tiết của booking đầu tiên
            return redirect()->route('bookings.show', $created[0]->id)->with('success', 'Đặt vé thành công!');
        } else {
            return back()->withErrors(['seat_ids' => 'Tất cả các ghế bạn chọn đã được đặt trước!'])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        return view('bookings.show', compact('booking'));
        return response()->json($booking->load(['showtime', 'seat', 'payment']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        return response(null, 204);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        $data = $request->validate([
            'showtime_id' => 'required|exists:showtimes,id',
            'seat_id' => 'required|exists:seats,id',
            'customer_name' => 'required',
            'customer_phone' => 'required',
            'status' => 'required|in:unpaid,paid',
        ]);
        $booking->update($data);
        return response()->json($booking->load(['showtime', 'seat', 'payment']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
