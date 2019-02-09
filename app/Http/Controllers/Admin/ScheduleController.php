<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleRequest;
use App\Http\Requests\ScheduleRequestUpdate;
use App\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ScheduleController extends Controller
{

	protected $schedule;

	public function __construct(Schedule $schedule)
	{
		    $this->schedule = $schedule;
	}


    public function index()
    {
        $schedules = $this->schedule->with('instructor_name_only')
                             ->where('status','!=','delete')
                             ->get();
    	  return view('admins.schedule',compact('schedules'));
    }

    public function create()
    {
    	return view('admins.scheduling');
    }

    public function store(ScheduleRequest $request)
    {
        $this->schedule->create($request->all());
        Session::flash('status','Schedule added succesfully');
        return redirect('/admin/scheduling');
    }

/**
 * [@show api for request schedule in student pre-enroll]
 * @param  [type] $information [description]
 * @return [type]              [description]
 */
    public function show($information)
    {
        $params = [];
        parse_str($information,$params);
        $schedules = DB::select(
          DB::raw('SELECT DISTINCT subjects.*,
          blocks.*,
          schedules.*,
          IF(COUNT(subject_pre_requisites.pre_requisite_code) >= 2,GROUP_CONCAT(subject_pre_requisites.pre_requisite_code),subject_pre_requisites.pre_requisite_code)  AS pre_requisite_code,
           (SELECT  IF(count(subject_pre_requisites.pre_requisite_code) >= 2 ,GROUP_CONCAT(sub_description),sub_description) FROM subjects WHERE sub IN (pre_requisite_code) GROUP BY sub ) as sub_pre_req_decription
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
             GROUP BY schedules.id
             ORDER BY blocks.course DESC
          '),$params
        );

        //FILTER REFACTOR THIS
        array_walk_recursive($schedules, function (&$value , $key) {
            array_walk($value ,function (&$schedule_value , $column_name) {
                if ($column_name  === 'start_time' || $column_name === 'end_time') {
                    $schedule_value = Carbon::parse($schedule_value)->format('g:i A');
                }
            });
        });

        return response()->json(['schedules' => $schedules]);
    }

    public function update(ScheduleRequestUpdate $request)
    {
       $this->schedule->find($request->schedule_id)
                       ->update($request->except(['schedule_id']));
        return response()->json(['success' => true]);
    }

}
