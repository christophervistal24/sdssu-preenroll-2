<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = ['subject_id','remarks','expiration'];

    public function student()
    {
    	return $this->belongsToMany(Student::class,'grade_student','grade_id','student_id_number');
    }
}
