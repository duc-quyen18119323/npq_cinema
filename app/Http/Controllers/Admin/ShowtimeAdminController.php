<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShowtimeAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $showtimes = \App\Models\Showtime::with(['movie', 'room'])->paginate(10);
        return view('admin.showtimes.index', compact('showtimes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $movies = \App\Models\Movie::all();
        $rooms = \App\Models\Room::all();
        return view('admin.showtimes.create', compact('movies', 'rooms'));
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
        \App\Models\Showtime::create($data);
        return redirect()->route('admin.showtimes.index')->with('success', 'Thêm suất chiếu thành công!');
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
        $showtime = \App\Models\Showtime::findOrFail($id);
        $movies = \App\Models\Movie::all();
        $rooms = \App\Models\Room::all();
        return view('admin.showtimes.edit', compact('showtime', 'movies', 'rooms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $showtime = \App\Models\Showtime::findOrFail($id);
        $data = $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'room_id' => 'required|exists:rooms,id',
            'show_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);
        $showtime->update($data);
        return redirect()->route('admin.showtimes.index')->with('success', 'Cập nhật suất chiếu thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $showtime = \App\Models\Showtime::findOrFail($id);
        $showtime->delete();
        return redirect()->route('admin.showtimes.index')->with('success', 'Xóa suất chiếu thành công!');
    }
}
