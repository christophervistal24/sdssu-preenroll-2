<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleRequest;
use App\Http\Requests\ScheduleRequestUpdate;
use App\Schedule;
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
 * [@show What is this? check this!!]
 * @param  [type] $information [description]
 * @return [type]              [description]
 */
    public function show($information)
    {
       /* $params = [];
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
        return response()->json(['schedules' => $schedules]);*/
    }

    public function update(ScheduleRequestUpdate $request)
    {
       $this->schedule->find($request->schedule_id)
                       ->update($request->except(['schedule_id']));
        return response()->json(['success' => true]);
    }

}
