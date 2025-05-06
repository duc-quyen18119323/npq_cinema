<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SeatAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $seats = \App\Models\Seat::with('room')->get();
        return view('admin.seats.index', compact('seats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rooms = \App\Models\Room::all();
        return view('admin.seats.create', compact('rooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'seat_number' => 'required',
            'type' => 'required|in:regular,vip',
        ]);
        \App\Models\Seat::create($data);
        return redirect()->route('admin.seats.index')->with('success', 'Thêm ghế thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $seat = \App\Models\Seat::findOrFail($id);
        $rooms = \App\Models\Room::all();
        return view('admin.seats.edit', compact('seat', 'rooms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $seat = \App\Models\Seat::findOrFail($id);
        $data = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'seat_number' => 'required',
            'type' => 'required|in:regular,vip',
        ]);
        $seat->update($data);
        return redirect()->route('admin.seats.index')->with('success', 'Cập nhật ghế thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $seat = \App\Models\Seat::findOrFail($id);
        $seat->delete();
        return redirect()->route('admin.seats.index')->with('success', 'Xóa ghế thành công!');
    }
}
