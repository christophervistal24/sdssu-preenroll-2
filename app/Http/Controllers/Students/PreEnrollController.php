<?php

namespace App\Http\Controllers\Students;

use App\Block;
use App\Grade;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePreEnroll as StorePreEnrollRequest;
use App\Schedule;
use App\Semester;
use App\Student;
use App\Traits\SchedUtils;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PreEnrollController extends Controller
{
	use SchedUtils;

	protected $schedule;
  protected $current_semester;
	public function __construct(Schedule $sched , Semester $semester)
	{
		  $this->schedule = $sched;
      $this->current_semester = $semester;
	}

    public function create()
    {
      $blocks = Block::orderBy('level','ASC')->get();
      $current_sem = $this->current_semester
                         ->where('current',1)
                         ->first(['id']);
    	$student_info = Student::where('id_number',Auth::user()->id_number)
                               ->first();
        $match = [
            'block_level'      => $student_info->year,
            'block_course'     => $student_info->course->course_code,
            'sched_status'     => 'active',
            'current_semester' => $current_sem->id,
        ];
        $schedules = $this->schedule
                          ->getScheduleWithMatch($match);
        return view('students.preenrol',compact('schedules','blocks','current_sem'));
    }

    public function store(StorePreEnrollRequest $request)
    {
	      $subjects = $request->subjects;
	      $subject_ids = array_keys($subjects);
	      $collected_ids  = [];
         $grade_id = [];
         array_walk_recursive($subjects, function ($v , $k) use (&$collected_ids) {
                      $collected_ids[] = $k;
          });
         array_walk($subject_ids , function ($value , $key)  use(&$grade_id) {
            $grade_id[] = Grade::create(['subject_id' => $value])->id;
         });
	      $student = Student::where('id_number',Auth::user()->id_number)->first();
	      try {
	            $student->schedules()->attach($collected_ids);
	            $student->student_subjects()->attach($subject_ids);
              $student->grades()->attach($grade_id);
	        } catch (Exception $e) {
	            return redirect()->back()->with('status','Successfully enrolled those subjects');
	        }
	        return redirect()->back()->with('status','Successfully enrolled those subjects');
    }
}
