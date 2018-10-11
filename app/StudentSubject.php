<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentSubject extends Model
{
	protected $primaryKey = 'student_id';
	public $incrementing  = false;
	protected $table      = 'student_subject';
    protected $fillable = ['student_id','subject_id','remarks'];

    public function getStudentGradeBySubject($student_id,$subject_id)
    {
    	$matchThese = ['student_id' => $student_id,'subject_id' => $subject_id];
    	return $this->where($matchThese)->first();
    }
}
