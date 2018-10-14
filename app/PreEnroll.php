<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PreEnroll extends Model
{
    protected $fillable = ['student_id','schedule_id'];

    public function schedule()
    {
    	$this->primaryKey = 'schedule_id';
    	return $this->hasMany('App\InstructorSchedule','id');
    }

    public function noOfRequest()
    {
    	return DB::table('pre_enrolls')
    			->select(DB::raw('student_id'))
                ->distinct('student_id')
                ->count('student_id');
    }
}
