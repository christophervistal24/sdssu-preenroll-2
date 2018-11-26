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
        $first_year  = Subject::getSubjectByYear(1);
        $second_year = Subject::getSubjectByYear(2);
        $third_year  = Subject::getSubjectByYear(3);
        $fourth_year = Subject::getSubjectByYear(4);
        $fifth_year  = Subject::getSubjectByYear(5);
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
                     'subject'    => Subject::where('sub_description',array_values($request->subject)[0])
                                       ->first()
                                        ->id,
                     'block'      => $request->block[0]
        ]);

        if (!$is_exists) {
           $this->schedule::create([
                 'start_time' => $request->start_time,
                 'end_time'   => $request->end_time,
                 'days'       => $request->days,
                 'room'       => $request->room,
                 'subject_id' => $this->schedule::getIdOfSubject(array_values($request->subject)[0]),
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
                     'subject'    => $this->schedule::getIdOfSubject($request->subject),
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
                            'subject_id' => $this->schedule::getIdOfSubject($request->subject),
                            'block'      => $request->block,
                        ]);
        return response()->json(['success' => true]);
    }

}
