<?php

namespace App;

use App\Semester;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['id_number','fullname','year','address','course_id','student_parent_id','mobile_number'];
    protected $primaryKey = 'id_number';

    /*public function subjects()
    {
    	return $this->belongsToMany(InstructorSchedule::class,'student_subject','student_id','subject_id');
    }
    */

    public function grades()
    {
        return $this->belongsToMany(Grade::class,'grade_student','student_id_number','grade_id');
    }

    public function student_subjects()
    {
        return $this->belongsToMany(Subject::class,'student_subject','student_id_number','subject_id');
    }


    public function parents()
    {
        return $this->hasOne('App\StudentParent','id','student_parent_id');
    }

    public function course()
    {
        $this->primaryKey = 'course_id';
        return $this->hasOne('App\Course','id');
    }

    public function schedules()
    {
        $this->primaryKey = 'id_number';
        return $this->belongsToMany('App\Schedule','schedule_student','student_id_number','schedule_id');
    }

    public function getStudentYearLevel($id_number)
    {
    	$getStudenYear = $this->where('id_number',$id_number)->first();
    	return (is_null($getStudenYear)) ? null : $getStudenYear->year;
    }

    public function checkIfCanLogin($id_number,Semester $semester)
    {
     return $this->getStudentYearLevel($id_number) == 1 && $semester->getCurrentSemester() != 'Second semester';
    }
}
