<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Instructor extends Model
{
	protected $table = 'instructors';
    protected $fillable = ['id_number','name','education_qualification','position','major','status','mobile_number','active'];

   public function schedules()
   {
   		$this->primaryKey = 'id_number';
   		return $this->belongsToMany('App\Schedule','instructor_schedule','instructor_id_number','schedule_id');
   }

   public function sched_student($id)
   {
   		return DB::table('schedule_student')->where('schedule_id',$id)->count();
   }

   public function startToGrade(array $match)
   {
      $is_graded = DB::table('instructor_schedule')->where($match)
                          ->first()
                          ->updated_at;
      if (!$is_graded) {
            DB::table('instructor_schedule')
                        ->where($match)
                       ->update(['updated_at' => Carbon::now()]);
      }
   }

}
