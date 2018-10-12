<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentSubject extends Model
{
	protected $primaryKey = 'student_id';
	public $incrementing  = false;
	protected $table      = 'student_subject';
    protected $fillable = ['student_id','subject_id','remarks'];

    public function getStudentGrade($student_id,$subject_id)
    {

    		$getRemarks = $this->where(['student_id' => $student_id,'subject_id' => $subject_id])
    				->first();
    		return isset($getRemarks->remarks) ? $getRemarks->remarks : null; 
    }
}
