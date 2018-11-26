<?php

namespace App\Http\Controllers\Students;

use App\Block;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\InstructorSchedule;
use App\PreEnroll;
use App\Schedule;
use App\Semester;
use App\Student;
use App\StudentGrade;
use App\StudentSubject;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Exception;

class StudentController extends Controller
{
    private $student;
    private $sem;
    private $schedule;
    public function __construct(Student $studnt,Semester $sem , Schedule $sched)
    {
        $this->student = $studnt;
        $this->sem = $sem;
        $this->schedule = $sched;
        $this->middleware('preventBackHistory');
    }

	public function index()
	{
		return view('students.index');
	}

    public function preenroldetails()
    {
        $student  = Student::where('id_number',Auth::user()->id_number)->first();
        $preenroll_request = PreEnroll::with('schedule')->where('student_id',$student->id)->get();
        return view('students.preenrolldetails',compact('preenroll_request'));
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
        $credentials = $request->only('id_number', 'password');
        $user = User::where('id_number',$request->id_number)->first();
        // $isStudentCanLogin = $this->student
        //                         ->checkIfCanLogin($request->id_number,$this->sem);
        // if ($isStudentCanLogin) {
        //   return Redirect::back()
        //             ->withInput()
        //             ->withErrors('You can\'t login on this page please wait till administrator make an action');
        // }
        if (Auth::attempt($credentials) && $user->hasRole('Student')) {
            return redirect()->intended('/student/index');
        }

        return Redirect::back()->withInput()->withErrors('Wrong ID number/password combination.');
    }
}
