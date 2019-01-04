<?php

namespace App\Http\Controllers\Instructors;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeAdminProfileRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Instructor;
use App\InstructorSchedule;
use App\Semester;
use App\Student;
use App\Subject;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class InstructorController extends Controller
{
    protected $student_subject;
    protected $instructor_info;
    public function __construct()
    {
        $this->middleware('preventBackHistory');
    }

    public function index()
    {
        return view('instructors.index');
    }

    /**
     * [store change password]
     * @param  Request    $request    [description]
     * @param  Instructor $instructor [description]
     * @return [type]                 [description]
     */
    public function store(ChangePasswordRequest $request ,Instructor $instructor)
    {
        $user_account = User::where('id_number',Auth::user()->id_number)->first();
        $user_account->password = $request->new_password;
        $user_account->save();
        return redirect()->back()->with('status','Successfully update your password');
    }

    /**
     * [update update information]
     * @param  Request    $request    [description]
     * @param  Instructor $instructor [description]
     * @return [type]                 [description]
     */
    public function update(ChangeAdminProfileRequest $request , Instructor $instructor)
    {
        $instructor->name = $request->fullname;
        $instructor->education_qualification = $request->education_qualification;
        $instructor->mobile_number = $request->mobile_number;
        $instructor->active = $request->status;
        $instructor->save();
        return redirect()->back()->with('status','Successfully update your profile');
    }

    public function students($first_subject,$second_subject = null)
    {

        return view('instructors.students');
    }


    public function sendsms()
    {
    	return view('instructors.sendsms');
    }

    public function login()
    {
    	return view('instructors.login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/instructorlogin');
    }


    public function checkLogin(LoginRequest $request)
    {
        $credentials = $request->only('id_number', 'password');
        $user = User::where('id_number',$request->id_number)->first();
        if (Auth::attempt($credentials) && $user->hasRole('Instructor')) {
            // Authentication passed...
            return redirect()->intended('/instructor/schedule');
        }
        return Redirect::back()->withInput()->withErrors('Wrong ID number/password combination.');
    }
}
