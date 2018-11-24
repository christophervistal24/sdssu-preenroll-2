<?php

namespace App\Http\Controllers\Instructors;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\InstructorSchedule;
use App\Semester;
use App\Instructor;
use App\Student;
use App\StudentGrade;
use App\StudentSubject;
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
    public function __construct(StudentSubject $student_sub)
    {
        $this->student_subject = $student_sub;
        $this->middleware('preventBackHistory');
    }

    public function index()
    {
        return view('instructors.index');
    }

    public function students($first_subject,$second_subject = null)
    {

        return view('instructors.students');
    }

    public function addstudentgrade(Request $request)
    {
        $current_semester = Semester::where('current',1)->first()->id;
        $student = StudentGrade::where(['student_id' => $request->student_id , 'subject_id' => $request->student_subject_id])->first();
        if (is_null($student)) {
             $student = new StudentGrade();
             $student->student_id = $request->student_id;
             $student->subject_id = $request->student_subject_id;
             $student->remarks    = $request->student_grade;
             $student->block      = $request->block;
             $student->semester   = $current_semester;
             $student->year       = $request->year;
             $student->expiration = Carbon::now()->addDays(30);
             $student->save();
        } else  {
            $student->remarks = $request->student_grade;
            $student->save();
        }

        return response()->json(['success' => true]);
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
            return redirect()->intended('/instructor/index');
        }
        return Redirect::back()->withInput()->withErrors('Wrong ID number/password combination.');
    }
}
