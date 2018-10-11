<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['id_number','fullname','year','course_id'];

    public function subjects()
    {
    	return $this->belongsToMany(Subject::class,'student_subject','student_id','subject_id');
    }
}
