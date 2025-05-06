<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Movie::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Nếu là API, không cần form tạo, trả về 204
        return response(null, 204);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'trailer_url' => 'nullable',
            'duration' => 'nullable|integer',
            'poster' => 'nullable',
            'status' => 'required|in:coming_soon,now_showing',
        ]);
        $movie = Movie::create($data);
        return response()->json($movie, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
        return response()->json($movie);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        // Nếu là API, không cần form sửa, trả về 204
        return response(null, 204);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Movie $movie)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'trailer_url' => 'nullable',
            'duration' => 'nullable|integer',
            'poster' => 'nullable',
            'status' => 'required|in:coming_soon,now_showing',
        ]);
        $movie->update($data);
        return response()->json($movie);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
