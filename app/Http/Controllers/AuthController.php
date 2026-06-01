<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // menampilkan halaman login
    public function showLogin()
    {
        return view('login'); // file: resources/views/login.blade.php
    }

    // proses login
    public function login(Request $request)
    {
        // 1. validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. cek apakah email ada
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Email belum terdaftar');
        }

        // 3. cek password
        if (!Auth::attempt($request->only('email', 'password'))) {
            return back()->with('error', 'Password salah');
        }

        // 4. kalau berhasil login
        return redirect()->route('dashboard');
    }

    // ================= REGISTER =================

    // menampilkan halaman register
    public function showRegister()
    {
        return view('register');
    }

    // proses register
    public function register(Request $request)
    {
        // validasi register
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        // simpan ke database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // kembali ke login
        return redirect()->route('login')->with('success', 'Akun berhasil dibuat');
    }

    // logout (opsional tapi penting)
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
