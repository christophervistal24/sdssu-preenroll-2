<?php

namespace App;

use App\Subject;
use Carbon\Carbon;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Schedule extends Model
{

  use Cachable;
	protected $table = 'schedules';
  protected $primaryKey = 'id';
	protected $fillable = ['start_time','end_time','days','room','subject_id','instructor','block'];

     /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('status', function (Builder $builder) {
            $builder->where('status', '!=', 'delete');
        });
    }

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

}
