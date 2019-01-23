<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class InstructorSchedule extends Model
{
   public $timestamp = false;

  

   public function preenrolrequest()
   {
      $this->primaryKey = 'id';
      return $this->belongsTo('App\PreEnroll','id','schedule_id');
   }

   public function getSubjectById($id)
   {
      return $this->where('id',$id)->first()->subject;
   }
}
