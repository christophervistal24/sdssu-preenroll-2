<?php

namespace App\Http\Controllers\Instructors;

use App\Grade;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGradeRequest;
use App\Http\Requests\StoreGradeRequest as EditGradeRequest;
use App\Schedule;
use App\Student;
use App\Subject;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Subject $subject)
    {
        $sched_students = $subject;
        return view('instructors.students',compact('sched_students','subject'));
    }

    public function addgrade(StoreGradeRequest $request, Subject $subject)
    {
        $student = Student::findOrFail($request->student_id_number);
        $grade = Grade::create(
            [
                'subject_id' => $request->subject_id,
                'remarks'    => $request->student_grade,
            ]
       );
        //add grade
        $student->grades()->attach($grade);
        return response()->json(['success' => true]);
    }

    public function editgrade(EditGradeRequest $request,$subject)
    {
        Grade::where('subject_id',$subject)->first()
                    ->update(['remarks' => $request->student_grade]);
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
