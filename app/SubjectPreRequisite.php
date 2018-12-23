<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class SubjectPreRequisite extends Model
{
    use Cachable;
	protected $table = 'subject_pre_requisites';
	protected $fillable = ['subject_id','pre_requisite_code'];
	public function subjects()
	{
		$this->primaryKey = 'subject_id';
		return $this->belongsTo('App\Subject','subject_id','id');
	}
}
