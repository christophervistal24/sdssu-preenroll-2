<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Student;
use App\Subject;
use App\Semester;
use Illuminate\Http\Request;
use Dompdf\Dompdf;

class StudentEvaluatePrintController extends Controller
{

    private $subjects_need_to_print;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function show(Student $id_number , $subject_semester , $subject_year,$is_report = null)
    {
        $student = $id_number;
        $s_grades = Student::find($student->id_number)
                        ->grades()
                        ->get()->filter(function ($value , $key) use($subject_semester,$subject_year) {
            return ($value->subject->semester == $subject_semester)
            and ($value->subject->year == $subject_year);
        });

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('admins.printforms.evaluate',compact('subject_semester','student','s_grades'));
        $pdf->setPaper('legal');
        return $pdf->stream();
    }

    public function printrange(Request $request)
    {
        $grades = preg_replace('/class=".*?"|\t/', '', $request->student_grades);;
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('admins.printforms.evaluate_range',compact('grades'));
        $pdf->setPaper('legal');
        return $pdf->stream();
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
