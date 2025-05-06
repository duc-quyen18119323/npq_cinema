<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MovieAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = \App\Models\Movie::paginate(10);
        return view('admin.movies.index', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.movies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'trailer_url' => 'nullable|url',
            'duration' => 'required|integer|min:1',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'status' => 'required|in:now_showing,coming_soon',
        ]);

        // Xử lý upload poster
        if ($request->hasFile('poster')) {
            $file = $request->file('poster');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->storeAs('public/posters', $filename);
            $data['poster'] = $filename;
        }

        \App\Models\Movie::create($data);
        return redirect()->route('admin.movies.index')->with('success', 'Thêm phim thành công!');
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
        $movie = \App\Models\Movie::findOrFail($id);
        return view('admin.movies.edit', compact('movie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $movie = \App\Models\Movie::findOrFail($id);
        $data = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'trailer_url' => 'nullable|url',
            'duration' => 'required|integer|min:1',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'status' => 'required|in:now_showing,coming_soon',
        ]);

        if ($request->hasFile('poster')) {
            $file = $request->file('poster');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->storeAs('public/posters', $filename);
            $data['poster'] = $filename;
        }

        $movie->update($data);
        return redirect()->route('admin.movies.index')->with('success', 'Cập nhật phim thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $movie = \App\Models\Movie::findOrFail($id);
        $movie->delete();
        return redirect()->route('admin.movies.index')->with('success', 'Xóa phim thành công!');
    }
}
