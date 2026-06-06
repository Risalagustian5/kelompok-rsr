<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // 1. Menampilkan halaman form login
    public function showLogin()
    {
        return view('auth.login'); 
    }

    // 2. Memproses aksi ketika user klik tombol submit login
    public function login(Request $request)
    {
        // Validasi input email dan password
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Proses autentikasi (mencocokkan ke database)
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Jika sukses, lempar ke halaman dashboard kelompokmu
            return redirect()->intended('/dashboard');
        }

        // Jika gagal, balikkan ke halaman login dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau password yang kamu masukkan salah.',
        ])->onlyInput('email');
    }
}