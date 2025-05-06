<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminLoginMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('is_admin_logged_in')) {
            return redirect()->route('admin.login')->with('error', 'Bạn cần đăng nhập quản trị.');
        }

        return $next($request);
    }
}
