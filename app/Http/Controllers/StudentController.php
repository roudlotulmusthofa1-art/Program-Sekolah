<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchoolClass;

class StudentController extends Controller
{
    // step1
    public function create()
    {
        return view('students.step1');
    }

    public function storeStep1(Request $request)
    {
        session([
            'step1' => $request->all(),
        ]);

        return redirect()->route('pendaftaransiswa.step2');
    }

    // step2

    public function step2()
    {
        return view('students.step2');
    }

    public function storeStep2(Request $request)
    {
        session([
            'step2' => $request->all(),
        ]);

        return redirect()->route('pendaftaransiswa.step3');
    }

    // step3
    public function step3()
    {
        return view('students.step3');
    }

    public function storeStep3(Request $request)
    {
        session([
            'step3' => $request->all(),
        ]);

        return redirect()->route('pendaftaransiswa.step4');
    }

    // step4
    public function step4()
    {
        return view('students.step4');
    }
    public function storeStep4(Request $request)
    {
        session([
            'step4' => $request->all(),
        ]);
        return redirect()->route('pendaftaransiswa.step5');
    }

    // step5
    public function step5()
    {
        return view('students.step5');
    }
    public function storeStep5(Request $request)
    {
        session([
            'step5' => $request->all(),
        ]);
        return redirect()->route('pendaftaransiswa.step6');
    }

    // step6
    public function step6()
    {
        return view('students.step6');
    }
    public function storeStep6(Request $request)
    {
        session([
            'step6' => $request->all(),
        ]);
        return redirect()->route('pendaftaransiswa.step7');
    }

    // step7
    
    public function step7()
    {
        return view('students.step7');
    }
    public function storeStep7(Request $request)
    {
        session([
            'step7' => $request->all(),
        ]);
        return redirect()->route('pendaftaransiswa.step8');


   
    $request->validate(
        [
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:5120',
        ],
        [
            'photo.required' => 'Pas Foto 3×4 wajib diupload.',
            'photo.image' => 'File harus berupa gambar.',
            'photo.mimes' => 'Format file harus JPG atau PNG.',
            'photo.max' => 'Ukuran file maksimal 5 MB.',
        ]
    );

    // Jika lolos validasi

    $photoPath = $request->file('photo')->store('photos', 'public');

    // Simpan ke session atau database
    session([
    'step7' => $request->except('photo'),    
    'photo' => $photoPath
    ]);
}
    // step8
    public function step8()
    {
        return view('students.step8');
    }
    public function storeStep8(Request $request)
    {
        session([
            'step8' => $request->all(),
        ]);
        return redirect()->route('pendaftaransiswa.step9');
    }

    // step9
    public function step9()
    {
        return view('students.step9');
    }
    public function storeStep9(Request $request)
    {
        session([
            'step9' => $request->all(),
        ]);
        return redirect()->route('pendaftaransiswa.step9');
    }


}
