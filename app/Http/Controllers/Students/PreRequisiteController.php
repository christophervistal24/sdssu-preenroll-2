<?php

namespace App\Http\Controllers\Students;

use App\Grade;
use App\Http\Controllers\Controller;
use App\Repository\StudentRepositories;
use App\Student;
use App\Subject;
use App\SubjectPreRequisite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class PreRequisiteController extends Controller
{
    protected $subject , $student_repo;

    public function __construct(Subject $sub , StudentRepositories $student_repo)
    {
        $this->subject = $sub;
        $this->student_repo = $student_repo;
    }

    public function checkSubject(Request $request)
    {

        $subjects = $request->session()->push('old_dragged_subjects',$request->subjects);
        $filtered = array_values(filterSubjectId($subjects)); //rebase the keys
        $search_id = null;
        $search_id = (!empty($filtered)) ? $filtered : $request->subjects;
        $noPrereq = $this->subject
                         ->getPreRequisite($search_id)
                         ->toArray();
        if (!empty($noPrereq)) {
            $count_student_remarks = $this->student_repo
                                  ->countStudentSubjectGrade(Auth::user()->id_number,$noPrereq);
            if ($count_student_remarks == count($noPrereq)) {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false , 'message' => 'You can click the subject to view the pre-requisite maybe you don\'t a have grade.']);
            }
        }
    }

}
