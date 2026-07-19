<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUstadzController extends Controller
{
    public function index(Request $request)
    {
        $teachers = Teacher::query()
            ->when($request->search, function ($q) use ($request) {
                $q->where(function ($qq) use ($request) {
                    $qq->where('teacher_name', 'like', "%{$request->search}%")
                        ->orWhere('kode', 'like', "%{$request->search}%")
                        ->orWhere('email', 'like', "%{$request->search}%");
                });
            })
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('admin.ustadz.index', compact('teachers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'teacher_name' => 'required|string|max:255',
            'birth_place' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'kode' => 'nullable|string|max:10|unique:teachers,kode',
            'status' => 'nullable|in:aktif,cuti,nonaktif',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'email' => 'required|email|unique:teachers,email',
            'whatsapp' => 'required|string|max:20',
            'catatan' => 'nullable|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        $validated['kode'] = $this->generateKode($validated['teacher_name']);
        $validated['status'] = 'aktif';

        Teacher::create($validated);

        return redirect()->route('ustadz.index')->with('success', 'Ustadz berhasil ditambahkan.');
    }

    public function update(Request $request, Teacher $teacher)
    {
        
        $validated = $request->validate([
            'teacher_name' => 'required|string|max:255',
            'birth_place' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'kode' => 'nullable|string|max:10|unique:teachers,kode,' . $teacher->id,
            'status' => 'nullable|in:aktif,cuti,nonaktif',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'email' => 'required|email|unique:teachers,email,' . $teacher->id,
            'whatsapp' => 'required|string|max:20',
            'catatan' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8',
        ]);
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }
        $teacher->update($validated);

        return redirect()->route('ustadz.index')->with('success', 'Data ustadz diperbarui.');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();

        return back()->with('success', 'Data ustadz dihapus.');
    }

    // Tombol Aktif / Cuti / Non Aktif
    public function updateStatus(Request $request, Teacher $teacher)
    {
        $request->validate(['status' => 'required|in:aktif,cuti,nonaktif']);

        $teacher->update(['status' => $request->status]);

        return back()->with('success', 'Status ustadz diperbarui.');
    }

    // Tombol "Berikan Akses"
    public function giveAccess(Teacher $teacher)
    {
        if ($teacher->user_id) {
            return back()->with('error', 'Ustadz ini sudah memiliki akses akun.');
        }

        $user = User::create([
            'name' => $teacher->teacher_name,
            'email' => $teacher->email,
            'password' => $teacher->password, // sudah ter-hash saat registrasi
            'role' => 'guru',
        ]);

        $teacher->update(['user_id' => $user->id]);

        return back()->with('success', 'Akses berhasil diberikan ke ' . $teacher->teacher_name);
    }

    private function generateKode(string $name): string
    {
        $words = preg_split('/\s+/', trim($name));
        $initials = collect($words)->map(fn($w) => mb_strtoupper(mb_substr(preg_replace('/[^A-Za-z]/', '', $w), 0, 1)))->implode('');
        $base = substr($initials, 0, 3) ?: 'UST';

        return DB::transaction(function () use ($base) {
            $suffix = 0;
            do {
                $kode = $suffix === 0 ? $base : $base . $suffix;
                $exists = Teacher::where('kode', $kode)->lockForUpdate()->exists();
                $suffix++;
            } while ($exists);

            return $kode;
        });
    }
}
