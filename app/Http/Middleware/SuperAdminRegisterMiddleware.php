<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SuperAdminRegisterMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Memeriksa apakah pengguna sedang masuk dan memiliki peran 'superadmin'
        if ($request->user() && $request->user()->role === 'superadmin') {
            return $next($request);
        }

        // Jika bukan superadmin, arahkan ke halaman lain (misalnya, halaman dashboard) atau beri pesan error
        return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
    }
}
