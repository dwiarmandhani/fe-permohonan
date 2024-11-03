<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class AuthController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:15',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $response = $this->client->post('https://apipermohonan.explorasi.com/api/register', [
            'json' => [
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => $request->password,
                'password_confirmation' => $request->password_confirmation,
            ]
        ]);

        if ($response->getStatusCode() === 201) {
            return redirect()->route('login')->with('success', 'Registration successful. Please login.');
        }

        return back()->withErrors(['registration' => 'Registration failed.']);
    }

    public function showLoginForm()
    {
        return view('auth.login'); // Nama view untuk login
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
        ]);


        try {
            $response = $this->client->post('https://apipermohonan.explorasi.com/api/login', [
                'json' => [
                    'email' => $request->email,
                    'password' => $request->password,
                ],
                'http_errors' => false, // Menghindari pengecualian otomatis
            ]);

            $data = json_decode($response->getBody(), true);

            if (isset($data['success']) && $data['success']) {
                session(['access_token' => $data['access_token']]);
                return redirect()->route('home')->with('success', 'Login successful.');
            }

            return back()->withErrors(['login' => 'Invalid Credentials']);

        } catch (ClientException $e) {
            // Log respons kesalahan untuk debugging
            $errorResponse = json_decode($e->getResponse()->getBody(), true);
            \Log::error('Login failed', [
                'error' => $errorResponse,
                'email' => $request->email, // Jangan simpan password
            ]);

            return back()->withErrors(['login' => 'Invalid Credentials']);
        }
    }

    public function logout(Request $request)
    {
        // Hapus access token dari session
        Session::forget('access_token');

        // $accessToken = session('access_token');
        // Redirect ke halaman login
        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }

    public function getProfile()
    {
        $accessToken = session('access_token');

        if (!$accessToken) {
            return redirect()->route('login')->with('error', 'You must be logged in to access this page.');
        }

        try {
            $response = $this->client->get('https://apipermohonan.explorasi.com/api/profile', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                ]
            ]);

            $profile = json_decode($response->getBody(), true);

            // var_dump($profile);die;

            return view('profile.my-account', ['profile' => $profile]);
        } catch (\Exception $e) {
            return back()->withErrors(['api' => 'Unable to retrieve profile data.']);
        }
    }

    // Proses update profil
    public function updateProfile(Request $request)
    {
        $accessToken = session('access_token');

        if (!$accessToken) {
            return redirect()->route('login')->with('error', 'You must be logged in to update profile.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
        ]);

        try {
            $response = $this->client->put('https://apipermohonan.explorasi.com/api/profile', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                ],
                'json' => [
                    'name' => $request->name,
                    'username' => $request->username,
                    'email' => $request->email,
                    'phone' => $request->phone,
                ]
            ]);

            $data = json_decode($response->getBody(), true);

            if ($data['success']) {
                return redirect()->route('profile.show')->with('success', 'Profile successfully updated.');
            }

            return back()->withErrors(['update' => 'Failed to update profile.']);
        } catch (\Exception $e) {
            return back()->withErrors(['update' => 'Unable to update profile.']);
        }
    }

    public function showUpdatePassword()
    {
        $accessToken = session('access_token');

        // dd($accessToken);

        if (!$accessToken) {
            return redirect()->route('login')->with('error', 'You must be logged in to access this page.');
        }
        return view('profile.showUpdatePassword');
    }



    public function updatePassword(Request $request)
    {
        $accessToken = session('access_token');

        if (!$accessToken) {
            return redirect()->route('login')->with('error', 'You must be logged in to access this page.');
        }

        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        try {
            $response = $this->client->post('https://apipermohonan.explorasi.com/api/change-password', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                ],
                'json' => [
                    'current_password' => $request->current_password,
                    'new_password' => $request->new_password,
                    'new_password_confirmation' => $request->new_password_confirmation,
                ]
            ]);

            $data = json_decode($response->getBody(), true);
            // dd($data);

            if ($data['success']) {
                return redirect()->route('profile.changepassword')->with('success', 'Password successfully updated.');
            }

            return back()->withErrors(['error' => 'Failed to update password.']);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Unable to update password.']);
        }
    }



}
