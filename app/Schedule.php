<?php

namespace App;

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
     	 	$checkMatch = [
          'start_time' => $data['start_time'],
          'end_time'   => $data['end_time'],
          'days'       => $data['days'],
          'room'       => $data['room'],
          'subject_id' => $data['subject'],
          'block'      => $data['block'],
     	 	];
   		return $this->where($checkMatch)->count();
   }

   public function block_schedule()
   {
        $this->primaryKey = 'block';
        return $this->hasOne('App\Block','id');
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
    return DB::table('schedules')
            ->join('blocks','schedules.block' , '=' , 'blocks.id')
            ->join('subjects','schedules.subject_id' , '=' , 'subjects.id')
            ->select('subjects.*' , 'blocks.*' ,'schedules.*')
            ->where($match)
            ->get();
   }

}
