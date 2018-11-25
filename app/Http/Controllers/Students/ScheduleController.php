<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Schedule;
use App\Student;
use App\Traits\SchedUtils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    use SchedUtils;
    protected $student;

    public function __construct(Student $student)
    {
        $this->student = $student;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student_information = $this->student
                                ->where('id_number',Auth::user()->id_number)
                                ->first();
        return view('students.schedule',compact('student_information'));
    }

    public function checkSchedule(Request $request)
    {
        $schedule_credentials = $this->explodeGivenSubject(' - ',$request->subject);
        $sched =     $this->student
                          ->find($request->student_id_number) //get student schedules
                          ->schedules()
                          ->where($schedule_credentials)
                          ->get();

        return response()->json(['schedule_data' => $sched]);
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
