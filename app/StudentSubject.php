<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class StudentSubject extends Model
{
	protected $primaryKey = ['student_id','subject_id'];
	public $incrementing  = false;
	protected $table      = 'student_subject';
    protected $fillable = ['student_id','subject_id','remarks'];

    public function getDateStartedToGrade($student_id,$subject_id)
    {
        $getRemarks = $this->where(['subject_id' => $subject_id])
                    ->first();
            return isset($getRemarks->updated_at) ? $getRemarks->updated_at : null;
    }

    public function getStudents($data = [])
    {
        if ($data['second_subject'] != null) {
            $matches = ['subject_id' => $data['first_subject'] , 'subject_id' => $data['second_subject']];
            return $this->where($matches)->pluck('student_id');
        }
        return $this->where('subject_id',$data['first_subject'])->pluck('student_id');
    }

    protected function setKeysForSaveQuery(Builder $query)
    {
        $keys = $this->getKeyName();
        if(!is_array($keys)){
            return parent::setKeysForSaveQuery($query);
        }

        foreach($keys as $keyName){
            $query->where($keyName, '=', $this->getKeyForSaveQuery($keyName));
        }

        return $query;
    }


    // *
    //  * Get the primary key value for a save query.
    //  *
    //  * @param mixed $keyName
    //  * @return mixed

    protected function getKeyForSaveQuery($keyName = null)
    {
        if(is_null($keyName)){
            $keyName = $this->getKeyName();
        }

        if (isset($this->original[$keyName])) {
            return $this->original[$keyName];
        }

        return $this->getAttribute($keyName);
    }
}
