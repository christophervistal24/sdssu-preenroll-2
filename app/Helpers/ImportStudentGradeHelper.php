<?php
namespace App\Helpers;
use App\Student;
use App\Grade;
use App\Subject;


class ImportStudentGradeHelper {

    private $student_records , $subject , $csvUtil;

    public function __construct(Subject $subject , CSVUtilities $csvUtil)
    {
        $this->subject = $subject;
        $this->csvUtil = $csvUtil;
    }

    public function load($request,$chunkedBy)
    {
        $this->student_records = $this->csvUtil
                                        ->toArrayAndChunk($request,$chunkedBy);
    }

    public function insertStudentGrade(Student $student , Grade $grade)
    {
        $this->insertAndIterate($student,$grade);
    }

    private function insertAndIterate(Student $student , Grade $grade)
    {
        for($i = 0; $i<count($this->student_records); $i++)
        {
            //insert new grade
            $grade_model = new Grade();
            $grade_model->subject_id = $this->subject // get and set the id of the subject
                                     ->where('sub',$this->student_records[$i][1])
                                     ->first()->id;
            $grade_model->remarks = $this->student_records[$i][2]; // set value subject remarks
            $grade_model->save();
            //insert to pivot
            ($grade_model->save()) ? $this->attachToPivot(['student_id_number' => $this->student_records[$i][0],'grade_id' => $grade_model->id]) : null;

        }
    }

    private function attachToPivot($items = [])
    {
        return Student::find($items['student_id_number'])
                      ->grades()->attach($items['grade_id']);
    }
}

?>