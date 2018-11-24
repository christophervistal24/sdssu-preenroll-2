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
    	$schedules = Instructor::where('id_number',Auth::user()->id_number)
                            ->with('schedules')
                            ->get();
    	return view('instructors.schedule',compact('schedules'));
    }
}
