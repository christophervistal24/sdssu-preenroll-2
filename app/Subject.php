<?php

namespace App;

use App\Grade;
use App\Schedule;
use App\Semester;
use Illuminate\Support\Facades\DB;
use App\SubjectPreRequisite as SubPre;
use Illuminate\Database\Eloquent\Model;



class Subject extends Model
{
    protected $fillable = [
    	'sub','sub_description','units','prereq','year','semester','course'
	];

	public function pre_req()
	{
		return $this->hasMany('App\SubjectPreRequisite','subject_id');
    }


    public function schedule_sub()
    {
        return $this->belongsTo(Schedule::class,'id','subject_id');
    }

    public function scheduleTest()
    {
        $this->primaryKey = 'id';
        return $this->hasOne(Schedule::class,'id');
    }

    public function subject_students()
    {
        return $this->belongsToMany(Student::class,'student_subject','subject_id','student_id_number');
    }

    public function grade()
    {
        return $this->hasOne(Grade::class);
    }


	public function addPrerequisite($subject,$request_pre)
	{
        // dd($request_pre);
        if (isset($request_pre)) {
			$subject = $this->find($subject->id);
            $pre_requisite = [];
            $this->addManyPreQuisite($subject,$request_pre);
        }
	}

        public function updatePreRequisite($subject,$request_pre)
        {
                $subject = $this->find($subject->id);
                if(isset($request_pre)) {
                    $this->deleteManyPreQuisite($subject,$request_pre);
                } else {
                    $this->deleteOnlyOnePreQuisite($subject);
                }
                $this->addPrerequisite($subject,$request_pre);
        }

        public function deleteOnlyOnePreQuisite($subject)
        {
             $subject->pre_req()
                                ->where('subject_id',$subject->id)
                                ->delete();
        }

        public function deleteManyPreQuisite($subject,$request_pre)
        {
            foreach ($request_pre as $subject_code) {
                        $subject->pre_req()
                                ->where('subject_id',$subject->id)
                                ->delete();
            }
        }

        public function addManyPreQuisite($subject,$request_pre)
        {
              foreach ($request_pre as $subject_code) {
                $pre_requisite[] = new SubPre(
                        ['subject_id' => $subject->id ,
                        'pre_requisite_code' => $subject_code,
                        'course' => $subject->course,]
                );
            }
            $subject->pre_req()->saveMany($pre_requisite);
        }

        public function getPreRequisite($search_id)
        {
            return SubjectPreRequisite::where('subject_id',$search_id)->pluck('pre_requisite_code');
        }

        public function subjectWithPrerequisite()
        {
           return DB::select('
                 SELECT
                    subjects.id,
                    subjects.sub,
                    subjects.sub_description,
                    subjects.units,
                    subjects.year,
                    subjects.course,
                    subjects.semester,
                    GROUP_CONCAT(
                        subject_pre_requisites.pre_requisite_code
                    ) AS subject_pre_requisites
                FROM
                    subjects
                LEFT JOIN subject_pre_requisites ON subjects.id = subject_pre_requisites.subject_id
                GROUP BY
                    subjects.id
                ');
        }

        public function subjectPreRequisites()
        {
           return DB::select('
                SELECT 
                    subjects.id,
                    subjects.sub,
                    subjects.sub_description
                FROM
                    subjects
                LEFT JOIN subject_pre_requisites ON subjects.id = subject_pre_requisites.subject_id
                GROUP BY
                    subjects.sub_description
                ');
        }

        public static function getSubjectByYear(int $year_level , int $semester = null)
        {
            if ($semester != null) {
                return self::where(['year' => $year_level,'semester' => $semester])
                            ->get();
            }
            return self::where('year',$year_level)->get();
        }

        public static function getSubjectsByYearAndCourse(array $credentials = [])
        {
            return self::where([
                    'year'     => $credentials['year'],
                    'course'   => $credentials['course'],
                    'semester' => $credentials['semester'],
            ])
            ->get(['id','sub','sub_description','units','year','course','semester']);
        }

        public function getTotalUnits(array $credentials)
        {
            $semester = Semester::where('current',1)->first()->id;
            return $this->where([
                'year'     => $credentials['year'],
                'course'   => $credentials['course'],
                'semester' => $semester,
            ])->pluck('units')->sum();
        }
}
