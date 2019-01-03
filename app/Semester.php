<?php

namespace App;

use App\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Semester extends Model
{
   public function getCurrentSemester()
   {
   		return $this->where('current',1)->first()->semester;
   }

  public function actionBySemester($current_semester,$next_sem_request,$models)
  {
     $models['schedule_model']->query()->update(['status' => 'delete']);
     DB::table('schedule_student')->truncate();
     DB::table('student_subject')->truncate();
     // 2 , 1  - second semester to first semester
     if ($current_semester == 2 && $next_sem_request == 1) {
     } else if ($current_semester == 1 && $next_sem_request == 2) { // 1 , 2 first semester to second semester

     }
  }
}
