<?php

namespace App\Http\Controllers;

use App\Models\Guardian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GuardianController extends Controller
{
    /**
     * Menampilkan semua data wali
     */
    // public function index()
    // {
    //     $guardians = Guardian::all();

    //     return view('guardians.index', compact('guardians'));
    // }

    /**
     * Menampilkan form tambah wali
     */
    public function create()
    {
        return view('guardians.create');
    }

    /**
     * Menyimpan data wali
     */
    public function store(Request $request)
    {
        $request->validate([
            'guardian_name' => 'required',
            'whatsapp' => 'required',
            'password' => 'required|min:8|confirmed',
            'registration_code' => 'required|string',
        ]);

         // Cari siswa berdasarkan kode registrasi
    $student = Student::where(
        'registration_code',
        $request->registration_code
    )->first();

    // Jika kode tidak ditemukan
    if (!$student) {
        return back()->withErrors([
            'registration_code' => 'Kode registrasi tidak ditemukan.'
        ])->withInput();
    }

    // lanjut proses simpan guardian


    Guardian::create([

    'student_name' => $request->student_name,
    'birth_place' => $request->birth_place,
    'birth_date' => $request->birth_date,
    'gender' => $request->gender,
    'program' => $request->program,

    'guardian_name' => $request->guardian_name,
    'whatsapp' => $request->whatsapp,
    'email' => $request->email,

    'password' => Hash::make($request->password),

    'information_source' => $request->information_source,
]);

        return redirect()->route('guardians.index')->with('success', 'Data wali berhasil ditambahkan');
    }
    public function index()
    {
        $guardians = Guardian::latest()->get();

        return view('guardians.index', compact('guardians'));
    }
    public function show(string $id)
    {
        //
    }

    /**
     * Form edit
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update data
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Hapus data
     */
    public function destroy(string $id)
    {
        //
    }
}
