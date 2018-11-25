<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePreEnroll as StorePreEnrollRequest;
use App\Schedule;
use App\Student;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PreEnrollController extends Controller
{

	protected $schedule;

	public function __construct(Schedule $sched)
	{
		$this->schedule = $sched;
	}

    public function create()
    {
    	$student_info = Student::where('id_number',Auth::user()->id_number)
                               ->first();
        $match = [
            'blocks.level'     => $student_info->year,
            'blocks.course'    => $student_info->course->course_code,
            'schedules.status' => 'active',
        ];
        $schedules = $this->schedule
                          ->getScheduleWithMatch($match);
        return view('students.preenrol')->with('schedules',$schedules);
    }

    public function store(StorePreEnrollRequest $request)
    {
	      $subjects = $request->subjects;
	      $subject_ids = array_keys($subjects);
	      $collected_ids  = [];
	      array_walk_recursive($subjects, function ($v , $k) use (&$collected_ids) {
	            $collected_ids[] = $k;
	      });
	      $student = Student::where('id_number',Auth::user()->id_number)->first();
	      try {
	            $student->schedules()->attach($collected_ids);
	            $student->student_subjects()->attach($subject_ids);
	        } catch (Exception $e) {
	            return redirect()->back()->with('status','Successfully enrolled those subjects');
	        }
	        return redirect()->back()->with('status','Successfully enrolled those subjects');
    }
}
