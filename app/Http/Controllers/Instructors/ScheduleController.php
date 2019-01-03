<?php

namespace App\Http\Controllers\Instructors;

use App\Http\Controllers\Controller;
use App\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function index()
    {
    	$instructors = Instructor::where('id_number',Auth::user()->id_number)
                            ->with(['schedules' => function ($query) {
                                $query->where('status','!=','delete');
                            }])->get();
    	return view('instructors.schedule',compact('instructors'));
    }

    public function previousSchedules()
    {
        $instructors = Instructor::where('id_number',Auth::user()->id_number)
                            ->with(['schedules' => function ($query) {
                                $query->where('status','=','delete');
                            }])->get();
        return view('instructors.previous-schedule',compact('instructors'));
    }

}
