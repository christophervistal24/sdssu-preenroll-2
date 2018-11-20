<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SubjectPreRequisite as SubPre;

class Subject extends Model
{
    protected $fillable = [
    	'sub','sub_description','units','prereq','year','semester','course'
	];

	public function pre_req()
	{
		return $this->hasMany('App\SubjectPreRequisite');
	}

	public function addPrerequisite($subject,$request_pre)
	{
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
                        'pre_requisite_code' => $subject_code]
                );
            }
            $subject->pre_req()->saveMany($pre_requisite);
        }
}
