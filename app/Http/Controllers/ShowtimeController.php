<?php

namespace App\Http\Controllers;

use App\Models\Showtime;
use Illuminate\Http\Request;

class ShowtimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Showtime::with(['movie', 'room'])->get());
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
            'movie_id' => 'required|exists:movies,id',
            'room_id' => 'required|exists:rooms,id',
            'show_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);
        $showtime = Showtime::create($data);
        return response()->json($showtime->load(['movie', 'room']), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Showtime $showtime)
    {
        return response()->json($showtime->load(['movie', 'room']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Showtime $showtime)
    {
        return response(null, 204);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Showtime $showtime)
    {
        $data = $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'room_id' => 'required|exists:rooms,id',
            'show_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);
        $showtime->update($data);
        return response()->json($showtime->load(['movie', 'room']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Showtime $showtime)
    {
        $showtime->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
