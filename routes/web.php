<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermohonanController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/my-account', [AuthController::class, 'getProfile'])->name('profile.show');
Route::put('/my-account', [AuthController::class, 'updateProfile'])->name('profile.update');
Route::get('/change-password', [AuthController::class, 'showUpdatePassword'])->name('profile.changepassword');
Route::put('/change-password', [AuthController::class, 'updatePassword'])->name('profile.updatepassword');

Route::get('/permohonan', [PermohonanController::class, 'index'])->name('permohonan.index');
Route::get('/permohonan/create', [PermohonanController::class, 'showFormPengajuan'])->name('permohonan.create');
Route::post('/permohonan/store', [PermohonanController::class, 'store'])->name('permohonan.store');
Route::delete('/permohonan/{id}', [PermohonanController::class, 'destroy'])->name('permohonan.delete');
Route::get('/permohonan/{id}', [PermohonanController::class, 'showApplication'])->name('permohonan.show');
Route::put('/permohonan/{id}', [PermohonanController::class, 'edit'])->name('permohonan.update');
