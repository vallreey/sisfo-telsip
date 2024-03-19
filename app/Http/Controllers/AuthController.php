<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi data masukan
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Coba melakukan login
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Cek apakah pengguna memiliki peran 'superadmin'
            if (Auth::user()->role === 'superadmin') {
                // Jika ya, arahkan ke halaman dashboard superadmin
                return redirect()->route('superadmin.dashboard');
            } else {
                // Jika tidak, arahkan ke halaman dashboard biasa
                return redirect()->route('dashboard');
            }
        }

        // Jika login gagal, kembalikan ke halaman login dengan pesan error
        return back()->withErrors(['email' => 'These credentials do not match our records.'])->withInput($request->only('email'));
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users|max:255',
        'password' => 'required|string|min:8|confirmed',
        'role' => 'required|in:superadmin,admin,user', // Validasi role
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role, // Ambil peran dari formulir
    ]);

    // Redirect atau lakukan sesuatu setelah pendaftaran berhasil
    return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
}

public function listakun()
{
    return view('superadmin.listakun');
}



    public function logout(Request $request)
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
