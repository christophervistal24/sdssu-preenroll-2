<?php

namespace App;

use App\Subject;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Schedule extends Model
{

	protected $table = 'schedules';
    protected $primaryKey = 'id';
	protected $fillable = ['start_time','end_time','days','room','subject_id','instructor','block'];


    public function getStartTimeAttribute($value)
    {
      return Carbon::parse($value)->format('g:i A');
    }

    public function getEndTimeAttribute($value)
    {
      return Carbon::parse($value)->format('g:i A');
    }

    public function setStartTimeAttribute($value)
    {
       $this->attributes['start_time'] = Carbon::parse($value);
    }

    public function setEndTimeAttribute($value)
    {
       $this->attributes['end_time'] = Carbon::parse($value);
    }

    public function scopeExceptDelete($query)
    {
        return $query->where('status','!=','delete');
    }

    public function instructors()
    {
    	return $this->belongsToMany('App\Instructor','instructor_schedule','schedule_id','instructor_id_number')->withTimestamps();
    }

    public function instructor_name_only()
    {
      return $this->belongsToMany('App\Instructor','instructor_schedule','schedule_id','instructor_id_number')->select('name');
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
          CASE
              WHEN count(subject_pre_requisites.pre_requisite_code) >= 2
                  THEN
                  GROUP_CONCAT(
                    subject_pre_requisites.pre_requisite_code
                   )
              ELSE subject_pre_requisites.pre_requisite_code
          END AS pre_requisite_code
          FROM
              schedules
          LEFT JOIN subjects ON schedules.subject_id = subjects.id
          LEFT JOIN blocks ON schedules.block = blocks.id
          LEFT JOIN subject_pre_requisites
          ON subjects.id = subject_pre_requisites.subject_id  AND subjects.course = subject_pre_requisites.course
          WHERE
          blocks.level = :block_level
          AND
          blocks.course = :block_course
          AND
          schedules.status = :sched_status
          AND
          subjects.semester = :current_semester
          AND
          blocks.status = "open"
          GROUP BY
              schedules.id
          '),$match
    );
   }

   public function scopeIsExists($query)
   {
      return $query->exists();
   }

   public function isInBetweenOfSchedule()
   {
      $params = [
        'start_time' => Carbon::parse(request('start_time')),
        'end_time'   => Carbon::parse(request('end_time')),
        'room'       => request('room'),
        'block'      => request('block'),
        'days'       => request('days'),
        'status'     => 'active'
      ];

      return $this->where(array_except($params , ['start_time','end_time']))
        ->whereTime('start_time','<=',$params['start_time'])
        ->whereTime('end_time','>=',$params['end_time']);
   }

   public function assignCheckSchedule($schedule_id,$instructor_id_number)
   {
    //get the dragged schedule
    $schedule_information = Schedule::find($schedule_id);
    //get the schedules of the instructor
    $checkSameDay = Instructor::where('id_number',$instructor_id_number)
                            ->with(['schedules' => function ($q) use($schedule_information)  {
                              $q->where(['days' => $schedule_information->days]);
                            }])->get();
        $is_valid = [];
        if($checkSameDay) {
          $arr_schedule_information = array_except($schedule_information->toArray(),['created_at','updated_at']);
          array_walk_recursive($checkSameDay, function ($value , $key) use(&$arr_schedule_information,$schedule_information ,&$is_valid,&$index) {
            $value->schedules->filter(function ($value , $keys) use ($schedule_information , &$is_valid,&$arr_schedule_information) {
                if ($value->status != 'delete') {
                 //compare time
                $checkStartTime = (int) Carbon::parse($schedule_information->start_time)
                            ->equalTo(Carbon::parse($value->start_time));
                $checkEndTime = (int) Carbon::parse($schedule_information->end_time)
                            ->equalTo(Carbon::parse($value->end_time));
                 if ($checkStartTime == 1) {
                    $arr_schedule_information['conflicts']['start_time'] = array_except($value->toArray(),['pivot','created_at','updated_at','status']);
                }

                if ($checkEndTime == 1) {
                  $arr_schedule_information['conflicts']['end_time'] =  array_except($value->toArray(),['created_at','updated_at','pivot','status']);
                } 

                if ($checkEndTime == 1 && $checkStartTime == 1) {
                  $arr_schedule_information['conflicts']['start_time_and_end_time'] =  array_except($value->toArray(),['created_at','updated_at','pivot','status']);
                } 



                //check range time
                $checkRange = Carbon::parse($schedule_information->start_time)
                           ->between(
                            Carbon::parse($value->start_time),
                            Carbon::parse($value->end_time)
                           ,false);

                 $reverseCheckRange = Carbon::parse($value->start_time)
                           ->between(
                            Carbon::parse($schedule_information->start_time),
                            Carbon::parse($schedule_information->end_time)
                           ,false);



                 if ($checkRange == 1) {
                   $arr_schedule_information['conflicts']['range'] = array_except($value->toArray(),['created_at','updated_at','pivot','status']);
                 }

                 if ($reverseCheckRange == 1) {
                  $arr_schedule_information['conflicts']['range'] = array_except($value->toArray(),['created_at','updated_at','pivot','status']);
                 }

                $is_valid[] = (int) $checkStartTime;
                $is_valid[] = (int) $checkEndTime;
                $is_valid[] = (int) $checkRange;
                $is_valid[] = (int) $reverseCheckRange;
                }
            });
          });

          return ['schedule' => $arr_schedule_information , 'is_valid' => (boolean) !array_sum($is_valid)];
        }
   }

}
