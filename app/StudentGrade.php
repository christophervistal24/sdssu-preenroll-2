<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class StudentGrade extends Model
{

	protected $primaryKey = ['student_id','subject_id'];
    protected $dates = ['expiration'];
	public $incrementing  = false;

	protected $fillable = [
		'student_id','subject_id','remarks',
		'block','semester','year'
	];

	public function students()
	{
		return $this->belongsTo('App\Student');
	}

	public function getStudentGrades($data = [])
	{
		$matches = ['student_id' => $data['student_id'] , 'subject_id' => $data['subject_id']];
		$getRemarks = $this->where($matches)
    				->first();
    	return isset($getRemarks->remarks) ? $getRemarks->remarks : null;
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
