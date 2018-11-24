<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubjectPreRequisite extends Model
{
	protected $table = 'subject_pre_requisites';
	protected $fillable = ['subject_id','pre_requisite_code'];
	public function subjects()
	{
		$this->primaryKey = 'subject_id';
		return $this->belongsTo('App\Subject','subject_id','id');
	}
}
