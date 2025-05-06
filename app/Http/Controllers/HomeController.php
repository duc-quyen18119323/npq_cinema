<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class HomeController extends Controller
{
    public function index()
    {
        $nowShowing = Movie::where('status', 'now_showing')->get();
        $comingSoon = Movie::where('status', 'coming_soon')->get();
        return view('home', compact('nowShowing', 'comingSoon'));
    }
}
