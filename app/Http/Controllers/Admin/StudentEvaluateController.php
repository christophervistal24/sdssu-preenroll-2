<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Student;
use Illuminate\Http\Request;

class StudentEvaluateController extends Controller
{
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
        $first = [];
        foreach ($student->schedules as $s) {
                $first['subject'][] = $s->subject->sub;
                $first['subject_description'][] = $s->subject->sub_description;
                $first['block'][] = $s->block_schedule->level . '' . $s->block_schedule->course . '' . $s->block_schedule->block_name;
                $first['time'][] =  $s->start_time . ' - ' . $s->end_time;
                $first['days'][] =  $s->days;
                $first['rooms'][] = $s->room;
                foreach ($student->grades as $grade) {
                    if($grade->id == $s->subject->id) {
                        $first['grades'][] = $grade->remarks;
                    }
                }
                $first['semester'][] = (int) $s->subject->semester;
        }
        dd($first);
        return view('admins.studentevaluate',compact('student'));
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
