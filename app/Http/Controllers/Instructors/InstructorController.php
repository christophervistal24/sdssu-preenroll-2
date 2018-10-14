<?php

namespace App\Http\Controllers\Instructors;

use App\Http\Controllers\Controller;
use App\InstructorSchedule;
use App\Semester;
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
    public function __construct(StudentSubject $student_sub)
    {
        $this->student_subject = $student_sub;
        $this->middleware('preventBackHistory');
    }

    public function index()
    {
        return view('instructors.index');
    }

    public function schedule()
    {
        $schedules = DB::table('instructor_schedules')
            ->select(DB::raw("
                  subject,GROUP_CONCAT(block) as blocks,
                  GROUP_CONCAT(id) AS ids ,
                  GROUP_CONCAT(room) AS rooms ,
                  GROUP_CONCAT(CONCAT(start_time,' - ',end_time)) AS time ,
                  GROUP_CONCAT(DISTINCT days) AS days
              "))
            ->where('instructor','=',ucwords(Auth::user()->name))
            ->where('status','=','active')
            ->groupBy('subject')
            ->get();
    	return view('instructors.schedule',compact('schedules'));
    }

    public function students($first_subject,$second_subject = null)
    {
        //students with has already grades
        $students_with_grades = array_flatten(Student::whereHas('grades')->pluck('id'));
        $subject = InstructorSchedule::find($first_subject);
        $id = $this->student_subject->getStudents([
                'first_subject'  => $first_subject,
                'second_subject' => @$second_subject
        ]);

        $students_infos = DB::table('students')
                ->whereIn('id',$id)
                ->get(
                    ['id','id_number','fullname','year','course_id','block']
                );
        return view('instructors.students',compact(['students_infos','subject','students_with_grades']));
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
