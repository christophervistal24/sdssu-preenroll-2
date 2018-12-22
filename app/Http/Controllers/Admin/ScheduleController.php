<?php

namespace App\Http\Controllers\Admin;

use App\Block;
use App\Course;
use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleRequest;
use App\Repository\ScheduleRepository;
use App\Room;
use App\Schedule;
use App\Subject;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Exception;

class ScheduleController extends Controller
{

	protected $schedule,$scheduleRepo;
  protected $block;

	public function __construct(Schedule $schedule , Block $block , ScheduleRepository $schedule_repositories)
	{
		    $this->schedule = $schedule;
        $this->block = $block;
        $this->scheduleRepo = $schedule_repositories;
	}


    public function index()
    {
        $courses = Course::all();
        $rooms = Room::all();
        $blocks = Block::where('status','open')->orderBy('level', 'ASC')->get();
        $first_year  = Subject::getSubjectByYear(1);
        $second_year = Subject::getSubjectByYear(2);
        $third_year  = Subject::getSubjectByYear(3);
        $fourth_year = Subject::getSubjectByYear(4);
        $fifth_year  = Subject::getSubjectByYear(5);
    	  $schedules = Schedule::with('instructors')->where('status','!=','delete')->get();
    	  return view('admins.schedule',compact('schedules','first_year','second_year','third_year','fourth_year','fifth_year','rooms','blocks','courses'));
    }

    public function create()
    {
    	return view('admins.scheduling');
    }

    public function store(ScheduleRequest $request)
    {
        if($this->schedule->checkBetween($request)) {
          return redirect()
                 ->back()->withInput()->withErrors('Schedule is conflict to other');
        } else {
          $this->schedule->create([
               'start_time' => $request->start_time,
               'end_time'   => $request->end_time,
               'days'       => $request->days,
               'room'       => $request->room,
               'subject_id' => $this->schedule::getIdOfSubject(array_values($request->subject)[0]),
               'block'      => $request->block,
          ]);
          return redirect()->back()->with('status','Successfully add new schedule');
        }
    }

    public function show($information)
    {
        $params = [];
        parse_str($information,$params);
        $schedules = DB::select(
          DB::raw('SELECT
          subjects.*,
          blocks.*,
          schedules.*,
          subject_pre_requisites.pre_requisite_code,
          GROUP_CONCAT(
              subject_pre_requisites.pre_requisite_code
          ) AS pre_requisite_code
          FROM
              schedules
          LEFT JOIN subjects ON schedules.subject_id = subjects.id
          LEFT JOIN blocks ON schedules.block = blocks.id
          LEFT JOIN subject_pre_requisites ON subjects.id = subject_pre_requisites.subject_id
          WHERE
          blocks.level = :level
          AND
          blocks.course = :course
          AND
          schedules.status = "active"
          AND
          blocks.block_name = :block_name
          AND
          subjects.semester = :semester
          GROUP BY
              schedules.id
          ORDER BY blocks.course DESC
          '),$params
        );
        return response()->json(['schedules' => $schedules]);
    }

    public function update(ScheduleRequest $request)
    {
      if ($this->schedule->checkBetween($request)) {
          return response()->json(['success' => false]);
      }
        $sched = $this->schedule->find($request->schedule_id)
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
