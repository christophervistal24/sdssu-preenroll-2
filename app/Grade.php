<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Grade extends Model
{
    protected $fillable = ['subject_id','remarks','expiration'];

    protected $events = [
        'updated' => DeansList::class,
    ];

    public function student()
    {
    	return $this->belongsToMany(Student::class,'grade_student','grade_id','student_id_number');
    }

    //remove this relation
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
}
