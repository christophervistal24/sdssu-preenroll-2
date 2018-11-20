<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
	protected $table = 'schedules';
	protected $fillable = ['start_time','end_time','days','room','subject','instructor','block'];

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
    			'subject'    => $data['subject'],
    			'block'      => $data['block'],
     	 	];
   		return $this->where($checkMatch)->count();
   }

   public function block_schedule()
   {
        $this->primaryKey = 'block';
        return $this->hasOne('App\Block','id');
   }

}
