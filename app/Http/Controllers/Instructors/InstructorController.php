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
    protected $studentSubject;
    public function __construct(StudentSubject $studentSub)
    {
        $this->studentSubject = $studentSub;
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

    public function students(InstructorSchedule $subject_id)
    {
        $id = StudentSubject::where('subject_id',$subject_id->id)->pluck('student_id');
        $students_infos = DB::table('students')
                ->whereIn('id',$id)
                ->get(
                    ['id','id_number','fullname','year','course_id']
                );
        $id_of_subject = $subject_id->id;
        return view('instructors.students',compact(['students_infos','id','id_of_subject']));
    }

    public function addstudentgrade(Request $request)
    {

        $insStartToGrade = StudentSubject::where('subject_id',$request->student_subject_id)
                            ->first();

            $matchThese = [
                'student_id' => $request->student_id,
                'subject_id' => $request->student_subject_id
             ];

            $student = StudentSubject::where($matchThese)->first();
             if ($insStartToGrade->updated_at != null) {
                    $student->timestamps = false;
                    $student->remarks = $request->student_grade;
             } else {
                    $student->remarks = $request->student_grade;
             }
             $student->save();

            if ($student) {
                return response()->json([
                    'student_grade' => $request->student_grade,
                ]);
            }
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
