<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
    	'sub','sub_description','units','prereq','year','semester'
	];

	public function students()
	{
		return $this->belongsToMany(Student::class,'student_subject','subject_id','student_id');
	}
}
