<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleRequest;
use App\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{

	protected $schedule;

	public function __construct(Schedule $schedule)
	{
		$this->schedule = $schedule;
	}


    public function index()
    {
    	$schedules = Schedule::with('instructors')->get();
    	return view('admins.schedule',compact('schedules'));
    }

    public function create()
    {
    	return view('admins.scheduling');
    }

    public function store(ScheduleRequest $request)
    {
    	 $is_exists = $this->schedule
                           ->check([
                     'start_time' => $request->start_time,
                     'end_time'   => $request->end_time,
                     'days'       => $request->days,
                     'room'       => $request->room,
                     'subject'    => array_values($request->subject)[0],
                     'block'      => $request->block
        ]);

        if (!$is_exists) {
           Schedule::create([
                 'start_time' => $request->start_time,
                 'end_time'   => $request->end_time,
                 'days'       => $request->days,
                 'room'       => $request->room,
                 'subject'    => array_values($request->subject)[0],
                 'block'      => $request->block,
            ]);
            return redirect()->back()->with('status','Successfully add new schedule for ' . $request->instructor);
        } else {
            return redirect()->back()->withErrors('This schedule is already exists');
        }
    }
}
