<?php

namespace App;

use App\Block;
use App\Events\UpdateBlock;
use App\Semester;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Student extends Model
{
    protected $fillable = ['id_number','fullname','year','address','course_id','student_parent_id','mobile_number'];
    protected $primaryKey = 'id_number';

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

    public function deanslister()
    {
        return $this->hasOne('App\DeansList','student_id_number');
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

    public function getGrades($parameters)
    {
        /**
         * [as total_units "Subjects that meet the below 2.0 remarks"]
         */
        $current_sem = Semester::where('current',1)->first()->id;
        return DB::table('students')
                ->join('grade_student', 'students.id_number', '=', 'grade_student.student_id_number')
                ->join('grades', 'grade_student.grade_id', '=', 'grades.id')
                ->join('subjects', function ($join) use($parameters , $current_sem){
                        $join->on('subjects.id','=','grades.subject_id')
                        ->where(
                                //depending on current semester , student course , and student year_level
                                [
                                    'subjects.semester' => $current_sem,
                                    'subjects.course'   => $parameters['student_course'],
                                    'subjects.year'     => $parameters['student_year'],
                                ]
                        );
                })
                ->whereNotNull('grades.remarks')
                ->whereBetween('grades.remarks',[1.0,2.0])
                ->groupBy('students.id_number')
                ->orderBy('students.id_number','DESC')
                ->selectRaw('students.id_number,SUM(subjects.units) as total_units , students.year , students.course_id')
                ->get()
                ->toArray();
    }

    public function updateStudentBlock($block)
    {
        $student = $this->find(Auth::user()->id_number);
        $blockModel = new Block;
        if (empty($student->block)) {
            $find_block = $blockModel->find($block); //get other columns of the block
            $blockModel->findOrFail($find_block->id) //update the block
                   ->update(['no_of_enrolled' => ($find_block->no_of_enrolled + 1)]) ;
          \Event::fire( new UpdateBlock(new Block,$block)); // fire an event to check if block is full
          $student->block =  $block; // assign block to student
          $student->save();
        }
    }
}
