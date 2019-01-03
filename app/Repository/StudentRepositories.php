<?php
namespace App\Repository;

use App\Grade;
use App\Student;

class StudentRepositories
{
    private $grade , $subject_repo;

    public function __construct(Grade $grade , SubjectRepositories $subject_repo)
    {
        $this->grade = $grade;
        $this->subject_repo = $subject_repo;
    }

    public function countStudentSubjectGrade(int $student_id_number , $subjects = [])
    {
       $subject_ids = $this->subject_repo
                           ->getPrequisiteIdBySubject($subjects);
        return Student::find($student_id_number)
                         ->grades()
                         ->whereIn('subject_id',$subject_ids)
                         ->AllPassGrades()
                         ->get(['remarks'])
                         ->count();

       // $s =  $this->grade
       //              ->whereIn('subject_id',$subject_ids)
       //              ->StudentPassGrades($student_id_number)
       //              ->first()
       //              ->count();
       //              dd($s);
    }

}
?>