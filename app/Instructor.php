<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
	protected $table = 'instructors';
    protected $fillable = ['id_number','name','education_qualification','position','major','status','mobile_number','active'];

   public function schedules()
   {
   		$this->primaryKey = 'id_number';
   		return $this->belongsToMany('App\Schedule','instructor_schedule','instructor_id_number','schedule_id');
   }

}
