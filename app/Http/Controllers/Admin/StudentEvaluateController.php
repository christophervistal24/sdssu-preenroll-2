<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Semester;
use App\Student;
use App\Subject;
use Illuminate\Http\Request;

class StudentEvaluateController extends Controller
{

    public function __construct()
    {
        $this->middleware('preventBackHistory');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //display all
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
    public function show(Student $id_number)
    {
        $student = $id_number;
        $s_grades = Student::with(['grades','schedules' => function ($query) {
                $query->orderBy('created_at');
        }])->find($student->id_number);
        $grades = [];
        array_walk_recursive($s_grades->grades, function ($value , $key) use(&$grades) {
            $grades[
                $value->subject->year.'_year_'.$value->subject->semester.'_semester_subjects'
            ][] = $value;
        });

        return view('admins.studentevaluate',compact(['student','grades']));
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
