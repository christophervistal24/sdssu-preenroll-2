<?php
namespace App\Repository;

use App\Subject;

class SubjectRepositories
{
    private $subject;

    public function __construct(Subject $subject)
    {
        $this->subject = $subject;
    }

    public function getPrequisiteIdBySubject(array $subject_ids = []) : array
    {
           return $this->subject->whereIn('sub',$subject_ids)
                                    ->pluck('id')
                                    ->toArray();
    }


}
?>