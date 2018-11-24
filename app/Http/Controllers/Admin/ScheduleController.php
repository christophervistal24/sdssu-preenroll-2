<?php

namespace App\Http\Controllers\Admin;

use App\Block;
use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleRequest;
use App\Schedule;
use App\Subject;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{

	protected $schedule;
    protected $block;
	public function __construct(Schedule $schedule , Block $block)
	{
		$this->schedule = $schedule;
        $this->block = $block;
	}


    public function index()
    {
        $first_year  = Subject::where('year',1)->get();
        $second_year = Subject::where('year',2)->get();
        $third_year  = Subject::where('year',3)->get();
        $fourth_year = Subject::where('year',4)->get();
        $fifth_year  = Subject::where('year',5)->get();
    	$schedules = Schedule::with('instructors')->get();
    	return view('admins.schedule',compact('schedules','first_year','second_year','third_year','fourth_year','fifth_year'));
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
                 'subject_id'    => Subject::where('sub_description',array_values($request->subject)[0])->first()->id,
                 'block'      => $this->block->blockMatch($request->block),
            ]);
            return redirect()->back()->with('status','Successfully add new schedule');
        } else {
            return redirect()->back()->withErrors('This schedule is already exists');
        }
    }

    public function update(ScheduleRequest $request)
    {
        //check first if the schedule is already exists
      $is_exists = $this->schedule
                           ->check([
                     'start_time' => $request->start_time,
                     'end_time'   => $request->end_time,
                     'days'       => $request->days,
                     'room'       => $request->room,
                     'subject_id'    => Schedule::getIdOfSubject($request->subject),
                     'block'      => $request->block
        ]);
        // if schedule is already exists
        if ($is_exists) {
            return response()->json(['success' => false]);
        }
        $sched = Schedule::find($request->schedule_id)
                        ->update([
                            'start_time' => $request->start_time,
                            'end_time'   => $request->end_time,
                            'days'       => $request->days,
                            'room'       => $request->room,
                            'subject_id' => Schedule::getIdOfSubject($request->subject),
                            'block'      => $request->block,
                        ]);
        return response()->json(['success' => true]);
    }

}
