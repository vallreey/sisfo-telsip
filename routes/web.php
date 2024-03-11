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
        // Mengambil jumlah total absensi berdasarkan status
        $totalEmployees = \App\Models\Employee::count();
        $totalPresences = \App\Models\Presence::count();
        $totalPresent = \App\Models\Presence::where('status', 'present')->count();
        $totalPermission = \App\Models\Presence::where('status', 'permission')->count();
        $totalSick = \App\Models\Presence::where('status', 'sick')->count();
        $totalCuti = \App\Models\Presence::where('status', 'cuti')->count();

        return view('dashboard', compact('totalPresences', 'totalPresent', 'totalPermission', 'totalSick', 'totalCuti', 'totalEmployees'));
    })->name('dashboard');

    Route::middleware(['auth', 'superadmin'])->group(function () {
        Route::get('/superadmin', function () {
            // Mengambil jumlah total absensi berdasarkan status
        $totalEmployees = \App\Models\Employee::count();
        $totalPresences = \App\Models\Presence::count();
        $totalPresent = \App\Models\Presence::where('status', 'present')->count();
        $totalPermission = \App\Models\Presence::where('status', 'permission')->count();
        $totalSick = \App\Models\Presence::where('status', 'sick')->count();
        $totalCuti = \App\Models\Presence::where('status', 'cuti')->count();
            return view('superadmin/superadmin', compact('totalPresences', 'totalPresent', 'totalPermission', 'totalSick', 'totalCuti', 'totalEmployees'));
        })->name('superadmin.dashboard');
    });
    
    

    //ini untuk data karyawan
    Route::resource('employees', EmployeeController::class)->middleware('superadmin');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    //ini untuk presensi kehadiran
    Route::get('/attendance', [PresenceController::class, 'index'])->name('attendance.index');
    Route::get('/attendance/create', [PresenceController::class, 'create'])->name('attendance.create');
    Route::post('/attendance/store', [PresenceController::class, 'store'])->name('attendance.store');

});