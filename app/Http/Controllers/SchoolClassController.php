namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeacherRegistration;
use Illuminate\Support\Facades\Hash;

class TeacherRegistrationController extends Controller
{
    public function create()
    {
        return view('teachers.create');
    }

    public function store(Request $request)
    {
        $request->validate([

            'student_name' => 'required',

            'birth_place' => 'required',

            'birth_date' => 'required',

            'gender' => 'required',

            'whatsapp' => 'required',

            'email' => 'required|email|unique:teacher_registrations,email',

            'password' => 'required|min:8|confirmed',

        ]);

        Teacher::create([

            'student_name' => $request->student_name,

            'birth_place' => $request->birth_place,

            'birth_date' => $request->birth_date,

            'gender' => $request->gender,

            'whatsapp' => $request->whatsapp,

            'email' => $request->email,

            'password' => Hash::make($request->password),

        ]);

        return redirect()
            ->route('teachers.index')
            ->with('success', 'Pendaftaran guru berhasil');
    }

    public function index()
    {
        $teachers = TeacherRegistration::latest()->get();

        return view('teachers.index', compact('teachers'));
    }
}