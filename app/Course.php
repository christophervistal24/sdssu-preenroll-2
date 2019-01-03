<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
	public function getCourse($id)
	{
		return $this->where('id',$id)->first();
	}

	public function student()
	{
		return $this->belongsTo('App\Student');
	}

	public function getCourseCode($id)
	{
		return $this->where('id',$id)->first()->course_code;
	}
}
