<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Schedule extends Model
{

	protected $table = 'schedules';
  protected $primaryKey = 'id';
	protected $fillable = ['start_time','end_time','days','room','subject_id','instructor','block'];

    public function instructors()
    {
    	return $this->belongsToMany('App\Instructor','instructor_schedule','schedule_id','instructor_id_number');
    }

     public function check($data = [])
   	 {
      // add some in between validation
     	 	$checkMatch = [
          'start_time' => $data['start_time'],
          'end_time'   => $data['end_time'],
          'days'       => $data['days'],
          'room'       => $data['room'],
          'subject_id' => $data['subject'],
          'block'      => $data['block'],
     	 	];
   		return $this->where($checkMatch)->exists();
   }

   public function block_schedule()
   {
        $this->primaryKey = 'block';
        return $this->belongsTo(Block::class,'block','id');
   }

   public function subject()
   {
      $this->primaryKey = 'subject_id';
      return $this->hasOne('App\Subject','id');
   }

   public function students()
   {
      return $this->belongsToMany('App\Student','schedule_student','schedule_id','student_id_number');
   }

   public static function getIdOfSubject(string $subject) : string
   {
      return Subject::where('sub_description',$subject)->first()->id;
   }

   public function getAllSchedule()
   {
      return  DB::select('
                SELECT
        schedules.id AS schedule_id,
        GROUP_CONCAT(
            CONCAT(
                schedules.start_time,
                "-",
                schedules.end_time
            )
            ) AS time,
            GROUP_CONCAT(schedules.days) AS days,
            schedules.room,
            subjects.id AS subject_id,
            subjects.sub,
            GROUP_CONCAT(subjects.sub_description) AS subject,
            schedules.block,
            instructors.id_number as instructor_id_number,
            instructors.name as instructor_name
        FROM
            schedules
        LEFT JOIN instructor_schedule ON schedules.id = instructor_schedule.schedule_id
        LEFT JOIN instructors ON instructor_schedule.instructor_id_number = instructors.id_number
        INNER JOIN subjects ON schedules.subject_id = subjects.id
        GROUP BY
            subject_id
            ');
   }


   public function getScheduleWithMatch($match = [])
   {
    return DB::select(
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
          blocks.level = :block_level
          AND
          blocks.course = :block_course
          AND
          schedules.status = :sched_status
          AND
          subjects.semester = :current_semester
          GROUP BY
              schedules.id
          '),$match
    );
   }

   public function checkBetween($request) {
      $s = $this->where(['block' => $request->block,'days' => $request->days ,'status' => 'active'])
                 ->get(['start_time','end_time','days']); //get match block and days
      //parse the selected start time
      $selected_parse = Carbon::parse($request->start_time)->timestamp;
      //iterate
      return $s->filter(function ($item , $key) use ($selected_parse) {
          $start_time = Carbon::parse($item->start_time)->timestamp;
          $end_time   = Carbon::parse($item->end_time)->timestamp;
          return (($start_time <= $selected_parse) && ($selected_parse <= $end_time));
       });
   }

}
