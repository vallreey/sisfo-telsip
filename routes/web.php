<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PresenceController;

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


// Rute untuk halaman login dan register
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register']);

// Rute untuk halaman dashboard yang dilindungi oleh middleware
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    //ini untuk data karyawan
    Route::resource('employees', EmployeeController::class);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    //ini untuk presensi kehadiran
    Route::get('/attendance', [PresenceController::class, 'index'])->name('attendance.index');
    Route::get('/attendance/create', [PresenceController::class, 'create'])->name('attendance.create');
    Route::post('/attendance/store', [PresenceController::class, 'store'])->name('attendance.store');

});