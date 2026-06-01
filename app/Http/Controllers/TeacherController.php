<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function create()
    {
        return view('teachers.create');
    }

    public function store(Request $request)
    {
        Teacher::create([
            'student_name' => $request->student_name,
            'birth_place' => $request->birth_place,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'whatsapp' => $request->whatsapp,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

            return redirect()->route('teachers.index')
            ->with('success', 'Pendaftaran berhasil');
    }

    // TAMPILKAN DATA
    public function index()
    {
        $teachers = Teacher::latest()->get();

        return view('teachers.index', compact('teachers'));
    }
}