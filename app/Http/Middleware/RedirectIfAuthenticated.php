<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah session 'access_token' ada
        if (Session::has('access_token')) {
            // Jika ada, redirect ke home atau halaman lain
            return redirect()->route('home');
        }

        return $next($request);
    }
}
