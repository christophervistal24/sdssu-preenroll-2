<?php
namespace App\Repository;

use App\Grade;

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
       return $this->grade
                    ->whereIn('subject_id',$subject_ids)
                    ->StudentPassGrades($student_id_number)
                    ->get()
                    ->count();
    }

}
?>