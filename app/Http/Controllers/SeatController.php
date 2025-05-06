<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Seat::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response(null, 204);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'seat_number' => 'required',
            'type' => 'required|in:normal,vip',
        ]);
        $seat = Seat::create($data);
        return response()->json($seat, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Seat $seat)
    {
        return response()->json($seat);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Seat $seat)
    {
        return response(null, 204);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Seat $seat)
    {
        $data = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'seat_number' => 'required',
            'type' => 'required|in:normal,vip',
        ]);
        $seat->update($data);
        return response()->json($seat);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seat $seat)
    {
        $seat->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
