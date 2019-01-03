<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Grade extends Model
{
    protected $fillable = ['subject_id','remarks'];
    public const PASSING_GRADE  = 3.0;

    protected $events = [
        'updated' => [DeansList::class,SendStudentGrade::class],
    ];

    public function student()
    {
    	return $this->belongsToMany(Student::class,'grade_student','grade_id','student_id_number');
    }

    public function subject()
    {
        $this->primaryKey = 'subject_id';
        return $this->hasOne(Subject::class,'id');
    }


    public function updateGrade(Request $request , $subject_id = null)
    {
        $request->subject = ($subject_id) ?? $subject_id;
        $this->where('subject_id',$request->subject_id)->first()
                    ->update(['remarks' => $request->student_grade]);
    }

    public function scopeAllPassGrades($query)
    {
        return $query->where('remarks','<=',self::PASSING_GRADE);
    }

    public function scopeStudentPassGrades($query,$student_id_number)
    {
        return $this->AllPassGrades()
        ->with(['student' => function ($query) use ($student_id_number) {
            $query->where('id_number',$student_id_number);
        }]);
    }


}
