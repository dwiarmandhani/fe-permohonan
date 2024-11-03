<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman home.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $accessToken = session('access_token');

        if (!$accessToken) {
            return redirect()->route('login')->with('error', 'You must be logged in to access this page.');
        }
        return view('home');
    }
}
