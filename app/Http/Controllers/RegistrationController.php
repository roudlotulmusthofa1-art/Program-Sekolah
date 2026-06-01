<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User;
class RegistrationController extends Controller
{
    public function create()
    {
        return view('formulir');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'nullable|email|unique:users',
            'phone' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make('password123'),
        ]);

        $user->assignRole('wali_santri');

        return redirect('/login')->with('success', 'Pendaftaran berhasil');
    }
}
