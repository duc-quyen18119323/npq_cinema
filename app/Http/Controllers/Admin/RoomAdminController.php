<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoomAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = \App\Models\Room::all();
        return view('admin.rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'total_seats' => 'required|integer|min:1',
        ]);
        \App\Models\Room::create($data);
        return redirect()->route('admin.rooms.index')->with('success', 'Thêm phòng thành công!');
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
        $room = \App\Models\Room::findOrFail($id);
        return view('admin.rooms.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $room = \App\Models\Room::findOrFail($id);
        $data = $request->validate([
            'name' => 'required',
            'total_seats' => 'required|integer|min:1',
        ]);
        $room->update($data);
        return redirect()->route('admin.rooms.index')->with('success', 'Cập nhật phòng thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $room = \App\Models\Room::findOrFail($id);
        $room->delete();
        return redirect()->route('admin.rooms.index')->with('success', 'Xóa phòng thành công!');
    }
}
