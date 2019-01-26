<?php

namespace App\Http\Controllers\Students;

use App\Block;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\LoginRequest;
use App\InstructorSchedule;
use App\PreEnroll;
use App\Schedule;
use App\Semester;
use App\Student;
use App\StudentGrade;
use App\StudentSubject;
use App\Subject;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    private $subject;
    public function __construct(Subject $sub)
    {
        $this->subject = $sub;
        $this->middleware('preventBackHistory');
    }

	public function index()
	{
		return view('students.index');
	}

    public function store(ChangePasswordRequest $request,Student $student)
    {
        $user_account = User::where('id_number',Auth::user()->id_number)->first();
        $user_account->password = $request->new_password;
        $user_account->save();
        return redirect()->back()->with('status','Successfully update your password');
    }

    public function update(Request $request , Student $student)
    {
        $student->fullname = $request->fullname;
        $student->address = $request->address;
        $student->mobile_number = $request->mobile_number;
        $student->save();
        return redirect()->back()->with('status','Successfully update your profile');
    }

    public function changeprofile(Request $request)
    {   
        $this->validate($request,[
            'profile' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
        ]);
        //update the image of user in DB
        $image = request()->file('profile');
        $student = Student::find(Auth::user()->id_number);
        $student->profile = $image->getClientOriginalName();
        $student->save();
        //move the uploaded file
        if ($student) {
            $destination = storage_path('/app/public/profile/');
            $image->move($destination,$image->getClientOriginalName());
            return redirect()->back()->with('status','Successfully update your profile image');
        } else {
            return redirect()->back()->withErrors('Please check the image that you want to upload.');
        }
        
    }

	public function login()
    {
        return view('students.login');
    }

    public function logout()
    {
    	Auth::logout();
    	return redirect('/studentlogin');
    }

    public function checkLogin(LoginRequest $request)
    {
        $request->id_number = str_replace('-','',$request->id_number);
        $credentials = ['id_number' => $request->id_number, 'password' => $request->password];
        $user = User::where('id_number',$request->id_number)->first();
        if (Auth::attempt($credentials) && $user->hasRole('Student')) {
                return redirect()->intended('/student/index');
         }

        return Redirect::back()->withInput()->withErrors('Wrong ID number/password combination.');
    }
}
