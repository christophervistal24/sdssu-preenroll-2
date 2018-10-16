<?php

namespace App\Http\Controllers\Students;

use App\Block;
use App\Http\Controllers\Controller;
use App\InstructorSchedule;
use App\PreEnroll;
use App\Semester;
use App\Student;
use App\StudentGrade;
use App\StudentSubject;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class StudentController extends Controller
{
    private $student;
    private $sem;
    public function __construct(Student $studnt,Semester $sem)
    {
        $this->student = $studnt;
        $this->sem = $sem;
        $this->middleware('preventBackHistory');
    }

	public function index()
	{
		return view('students.index');
	}

	public function preenrol()
	{
        $student       = Student::where('id_number',Auth::user()->id_number)->first();
        $check_pending = PreEnroll::where('student_id',$student->id)->first();
        if ($check_pending) {
            return redirect('/student/preenroldetails')->with('status','Successfully send! below is your request details');
        }
          //combine the year level and course of student to get specific subjects
        $bracket = $student->year . $student->course->course_code;
        //get by year
        $schedules = InstructorSchedule::where('status','active')
                                        ->where('block','like','%' . $bracket . '%')
                                        ->get();
        return view('students.preenrol',compact(['student','schedules']));
	}

    public function submitpreenrol(Request $request)
    {
         if ($request->subjects == null) { //check if the admin add some subjects
            return Redirect::back()->withErrors('Please add some subject.');
         }
           array_map(function ($schedule_id) use($request)  { //iterate and insert the subjects
            $student_subject = new PreEnroll();
            $student_subject->student_id = $request->user_id;
            $student_subject->schedule_id = $schedule_id;
            $student_subject->save();
        },array_keys($request->subjects));

        return redirect()->back()->with('status','Success!');
    }

    public function preenroldetails()
    {
        $student  = Student::where('id_number',Auth::user()->id_number)->first();
        $preenroll_request = PreEnroll::with('schedule')->where('student_id',$student->id)->get();
        return view('students.preenrolldetails',compact('preenroll_request'));
    }

	public function evaluate()
	{
        $student_id = Student::where('id_number',Auth::user()->id_number)->first()->id;
        $student_subjects = Student::with('subjects')->where('id',$student_id)->first();
        $student_grades = StudentGrade::where('student_id',$student_id)->get();
		return view('students.evaluate',compact('student_grades','student_subjects'));
	}

	public function schedule()
	{
        $id_number = User::find(Auth::user()->id)
                    ->id_number;

        $student_information =  Student::where('id',
                    Student::where('id_number',$id_number)->first()->id)
                    ->with('subjects')
                    ->first();
		return view('students.schedule',compact('student_information'));
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

    public function checkLogin(Request $request)
    {
        $request->validate([
            'id_number' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('id_number', 'password');
        $user = User::where('id_number',$request->id_number)->first();
        $isStudentCanLogin = $this->student
                                ->checkIfCanLogin($request->id_number,$this->sem);
        if ($isStudentCanLogin) {
          return Redirect::back()
                    ->withInput()
                    ->withErrors('You can\'t login on this page please wait till administrator make an action');
        }
        if (Auth::attempt($credentials) && $user->hasRole('Student')) {
            return redirect()->intended('/student/index');
        }

        return Redirect::back()->withInput()->withErrors('Wrong ID number/password combination.');
    }
}
