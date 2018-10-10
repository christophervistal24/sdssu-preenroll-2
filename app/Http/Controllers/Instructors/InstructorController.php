<?php

namespace App\Http\Controllers\Instructors;

use App\Http\Controllers\Controller;
use App\InstructorSchedule;
use App\StudentSubject;
use App\Subject;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class InstructorController extends Controller
{
    public function __construct()
    {
        $this->middleware('preventBackHistory');
    }

    public function index()
    {
        return view('instructors.index');
    }

    public function schedule()
    {
        $schedules = InstructorSchedule::where('instructor',ucwords(Auth::user()->name))->get();
    	return view('instructors.schedule',compact('schedules'));
    }

    public function students(string $schedule)
    {
        $id       = Subject::where('sub_description',$schedule)->first()->id;
        $students = StudentSubject::where('subject_id',$id)->pluck('student_id');
        $students_infos = DB::table('students')
                ->whereIn('id',$students)
                ->get(
                    ['id','id_number','fullname','year','course_id']
                );
        return view('instructors.students',compact('students_infos'));
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


    public function checkLogin(Request $request)
    {
        $validatedData = $request->validate([
            'id_number' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('id_number', 'password');
        $user = User::where('id_number',$request->id_number)->first();
        if (Auth::attempt($credentials) && $user->hasRole('Instructor')) {
            // Authentication passed...
            return redirect()->intended('/instructor/index');
        }
        return Redirect::back()->withInput()->withErrors('Wrong ID number/password combination.');
    }
}
