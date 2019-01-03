<?php

namespace App;

use App\Student;
use App\Subject;
use Illuminate\Database\Eloquent\Model;

class DeansList extends Model
{
    protected $primaryKey = 'student_id_number';
    protected $fillable = ['student_id_number'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function insertQualifiedForDeansLister(Student $student , Subject $subject)
    {
        $students = $student->all(['id_number','course_id','year']);
        foreach ($students as $value) {
            $students = $student->getGrades(
                    [
                        'student_course' => $value->course_id,
                        'student_year'   => $value->year,
                    ]
            );
        }
        $students = json_decode(json_encode($students),true);
        foreach ($students as $keys => $value) {
            $units_that_need_to_meet = $subject->getTotalUnits([
                'year'   => $value['year'],
                'course' => $value['course_id'],
            ]);
            if ($value['total_units'] == $units_that_need_to_meet) {
                //if exists update otherswise insert new record
                $this->updateOrCreate(['student_id_number' => $students[$keys]['id_number']]);
            } else {
                unset($students[$keys]);
            }
        }

    }
}
