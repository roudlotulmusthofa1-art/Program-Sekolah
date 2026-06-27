<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PendaftaranSiswa;
class PendaftaranController extends Controller
{
        public function create()
    {
        return view('students.step1');
    }

    public function storeStep1(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nik' => 'required|digits:16',
            'email' => 'nullable|email|max:255',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'anak_ke' => 'required|integer|min:1',
            'jumlah_saudara' => 'required|integer|min:0',
            'alamat' => 'required|string',
            'no_telepon' => 'required|string|max:20',
        ]);

        // Simpan/update ke database (NIK sebagai identifier unik)
        $pendaftaran = PendaftaranSiswa::updateOrCreate(
            ['nik' => $request->nik],
            [
                'nama_lengkap' => $request->nama_lengkap,
                'nik' => $request->nik,
                'email' => $request->email,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'anak_ke' => $request->anak_ke,
                'jumlah_saudara' => $request->jumlah_saudara,
                'alamat' => $request->alamat,
                'no_telepon' => $request->no_telepon,
                'last_step' => 1,
            ],
        );

        // Simpan ID ke session untuk step selanjutnya
        session(['pendaftaran_id' => $pendaftaran->id]);

        return redirect()->route('pendaftaransiswa.step2');
    }

    // =============================================
    // STEP 2 - DATA ORANG TUA
    // =============================================

    public function step2()
    {
        return view('students.step2');
    }

    public function storeStep2(Request $request)
    {
        $request->validate([
            'father_name' => 'required|string|max:255',
            'father_job' => 'nullable|string|max:255',
            'father_email' => 'nullable|email|max:255',
            'father_phone' => 'required|string|max:20',
            'mother_name' => 'required|string|max:255',
            'mother_job' => 'nullable|string|max:255',
            'mother_email' => 'nullable|email|max:255',
            'mother_phone' => 'required|string|max:20',
            'address' => 'required|string',
            'income' => 'nullable|in:<1jt,1-3jt,3-5jt,5-10jt,>10jt',
        ]);

        $this->getPendaftaran()->update([
            'father_name' => $request->father_name,
            'father_job' => $request->father_job,
            'father_email' => $request->father_email,
            'father_phone' => $request->father_phone,
            'mother_name' => $request->mother_name,
            'mother_job' => $request->mother_job,
            'mother_email' => $request->mother_email,
            'mother_phone' => $request->mother_phone,
            'parent_address' => $request->address,
            'income' => $request->income,
            'last_step' => 2,
        ]);

        return redirect()->route('pendaftaransiswa.step3');
    }

    // =============================================
    // STEP 3 - PENDIDIKAN
    // =============================================

    public function step3()
    {
        return view('students.step3');
    }

    public function storeStep3(Request $request)
    {
        $request->validate([
            'school_name' => 'required|string|max:255',
            'education_level' => 'required|in:SD / MI,SMP / MTs,SMA / MA,SMK',
            'graduation_year' => 'required|digits:4|integer',
            'achievement' => 'nullable|string',
        ]);

        $this->getPendaftaran()->update([
            'school_name' => $request->school_name,
            'education_level' => $request->education_level,
            'graduation_year' => $request->graduation_year,
            'achievement' => $request->achievement,
            'last_step' => 3,
        ]);

        return redirect()->route('pendaftaransiswa.step4');
    }

    // =============================================
    // STEP 4 - KESEHATAN
    // =============================================

    public function step4()
    {
        return view('students.step4');
    }

    public function storeStep4(Request $request)
    {
        $request->validate([
            'blood_type' => 'nullable|in:A,B,AB,O',
            'medical_history' => 'nullable|string',
            'allergy' => 'nullable|string',
            'special_condition' => 'nullable|string',
        ]);

        $this->getPendaftaran()->update([
            'blood_type' => $request->blood_type,
            'medical_history' => $request->medical_history,
            'allergy' => $request->allergy,
            'special_condition' => $request->special_condition,
            'last_step' => 4,
        ]);

        return redirect()->route('pendaftaransiswa.step5');
    }

    // =============================================
    // STEP 5 - KEAGAMAAN
    // =============================================

    public function step5()
    {
        return view('students.step5');
    }

    public function storeStep5(Request $request)
    {
        $request->validate([
            'quran_reading_ability' => 'required|in:belum_bisa,iqro,terbata,lancar,tartil',
            'memorized_juz' => 'nullable|integer|min:0|max:30',
            'previous_pesantren' => 'required|in:ya,tidak',
            'religious_skill' => 'nullable|string',
        ]);

        $this->getPendaftaran()->update([
            'quran_reading_ability' => $request->quran_reading_ability,
            'memorized_juz' => $request->memorized_juz ?? 0,
            'previous_pesantren' => $request->previous_pesantren,
            'religious_skill' => $request->religious_skill,
            'last_step' => 5,
        ]);

        return redirect()->route('pendaftaransiswa.step6');
    }

    // =============================================
    // STEP 6 - INFO LAINNYA
    // =============================================

    public function step6()
    {
        return view('students.step6');
    }

    public function storeStep6(Request $request)
    {
        $request->validate([
            'hobby_talent' => 'nullable|string|max:255',
            'extracurricular_interest' => 'nullable|string|max:255',
            'future_goal' => 'nullable|string',
        ]);

        $this->getPendaftaran()->update([
            'hobby_talent' => $request->hobby_talent,
            'extracurricular_interest' => $request->extracurricular_interest,
            'future_goal' => $request->future_goal,
            'last_step' => 6,
        ]);

        return redirect()->route('pendaftaransiswa.step7');
    }

    // =============================================
    // STEP 7 - DOKUMEN
    // =============================================

    public function step7()
    {
        return view('students.step7');
    }

    public function storeStep7(Request $request)
    {
        $request->validate(
            [
                'photo' => 'required|image|mimes:jpg,jpeg,png|max:5120',
                'birth_certificate' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
                'family_card' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
                'certificate' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            ],
            [
                'photo.required' => 'Pas Foto 3×4 wajib diupload.',
                'photo.image' => 'Pas Foto harus berupa gambar.',
                'photo.mimes' => 'Format Pas Foto harus JPG atau PNG.',
                'photo.max' => 'Ukuran Pas Foto maksimal 5 MB.',
                'birth_certificate.required' => 'Akta Kelahiran wajib diupload.',
                'birth_certificate.max' => 'Ukuran Akta Kelahiran maksimal 5 MB.',
                'family_card.required' => 'Kartu Keluarga wajib diupload.',
                'family_card.max' => 'Ukuran Kartu Keluarga maksimal 5 MB.',
                'certificate.required' => 'Ijazah/SKL wajib diupload.',
                'certificate.max' => 'Ukuran Ijazah/SKL maksimal 5 MB.',
            ],
        );

        $pendaftaran = $this->getPendaftaran();

        // Upload masing-masing file ke storage
        $photoPath = $request->file('photo')->store('pendaftaran/foto', 'public');
        $aktaPath = $request->file('birth_certificate')->store('pendaftaran/akta', 'public');
        $kkPath = $request->file('family_card')->store('pendaftaran/kk', 'public');
        $ijazahPath = $request->file('certificate')->store('pendaftaran/ijazah', 'public');

        $pendaftaran->update([
            'photo' => $photoPath,
            'birth_certificate' => $aktaPath,
            'family_card' => $kkPath,
            'certificate' => $ijazahPath,
            'last_step' => 7,
        ]);

        return redirect()->route('pendaftaransiswa.step8');
    }

    // =============================================
    // STEP 8 - MOTIVASI
    // =============================================

    public function step8()
    {
        return view('students.step8');
    }

    public function storeStep8(Request $request)
    {
        $request->validate(
            [
                'alasan' => 'required|string|min:50',
            ],
            [
                'alasan.required' => 'Alasan mendaftar wajib diisi.',
                'alasan.min' => 'Alasan mendaftar minimal 50 karakter.',
            ],
        );

        $this->getPendaftaran()->update([
            'alasan' => $request->alasan,
            'last_step' => 8,
        ]);

        return redirect()->route('pendaftaransiswa.step9');
    }

    // =============================================
    // STEP 9 - VERIFIKASI & SUBMIT FINAL
    // =============================================

    public function step9()
    {
        $pendaftaran = $this->getPendaftaran();

        return view('students.step9', [
            'nama' => $pendaftaran->nama_lengkap ?? null,
            'nik' => $pendaftaran->nik ?? null,
            'sekolah' => $pendaftaran->school_name ?? null,
            'dokumen' => ($pendaftaran->countUploadedDocuments() ?? 0) . ' / 4 file',
        ]);
    }

    public function storeStep9(Request $request)
    {
        $request->validate(
            [
                'agree_rules' => 'required|in:1',
                'agree_payment' => 'required|in:1',
                'agree_data_truth' => 'required|in:1',
            ],
            [
                'agree_rules.in' => 'Anda harus menyetujui seluruh tata tertib.',
                'agree_payment.in' => 'Anda harus menyetujui kesanggupan membayar.',
                'agree_data_truth.in' => 'Anda harus menyatakan kebenaran data.',
            ],
        );

        $this->getPendaftaran()->update([
            'agree_rules' => true,
            'agree_payment' => true,
            'agree_data_truth' => true,
            'status' => 'dalam_proses',
            'last_step' => 9,
        ]);

        // Hapus session setelah submit
        $id = session('pendaftaran_id');
        session()->forget('pendaftaran_id');

        // Kirim ID ke halaman success via session flash
        session()->flash('pendaftaran_id', $id);

        return redirect()->route('pendaftaransiswa.success');
    }

    // halaman success
    public function success()
    {
        // Ambil data pendaftaran dari session flash untuk ditampilkan
        $pendaftaran = null;
        if (session('pendaftaran_id')) {
            $pendaftaran = PendaftaranSiswa::find(session('pendaftaran_id'));
        }

        return view('students.success', compact('pendaftaran'));
    }

    
    /**
     * Ambil record pendaftaran dari session ID.
     * Redirect ke step 1 jika session tidak ada.
     */
    private function getPendaftaran(): PendaftaranSiswa
    {
        $id = session('pendaftaran_id');

        if (!$id) {
            abort(redirect()->route('pendaftaransiswa.step1')->with('error', 'Sesi pendaftaran tidak ditemukan. Silakan mulai dari awal.'));
        }

        return PendaftaranSiswa::findOrFail($id);
    }

}
