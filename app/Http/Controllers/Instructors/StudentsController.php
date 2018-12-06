<?php

namespace App\Http\Controllers\Instructors;

use App\Grade;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGradeRequest as EditGradeRequest;
use App\Http\Requests\StoreGradeRequest;
use App\Instructor;
use App\Schedule;
use App\Student;
use App\Subject;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentsController extends Controller
{
    protected $grade , $instructor;
    public function __construct(Grade $grade , Instructor $instructor)
    {
        $this->grade = $grade;
        $this->instructor = $instructor;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Schedule $subject)
    {
        $sched_students = $subject;
        $startToGrade   = false;
        foreach ($subject->instructors as $subject_sched) {
            if (isset($subject_sched->pivot->updated_at)) {
                if (Carbon::now()->parse()->gte(Carbon::parse($subject_sched->pivot->updated_at->addDays(45)))) {
                    $expiration = true;
                }
                $startToGrade = true;
            }
        }

        return view('instructors.students',compact('sched_students','subject','expiration','startToGrade'));
    }

    public function addgrade(StoreGradeRequest $request,  Schedule $subject = null)
    {
        $match = [
            'instructor_id_number' => Auth::user()->id_number,
            'schedule_id'          => $request->schedule_id,
        ];
        $this->instructor->startToGrade($match); // update the timestamp in table
        $grade = $this->grade->find($request->grade_id);
        $grade->remarks = $request->student_grade;
        $grade->save();
        return response()->json(['success' => true]);
    }

    public function editgrade(EditGradeRequest $request, Schedule $subject = null)
    {
        $grade = $this->grade->find($request->grade_id);
        $grade->remarks = $request->student_grade;
        $grade->save();
        return response()->json(['success' => true]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
