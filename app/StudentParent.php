<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentParent extends Model
{
	protected $fillable = ['mothername','fathername','mobile_number'];

    public function students()
    {
    	return $this->belongsTo('App\Student','id','student_parent_id');
    }

    public static function getLastRecord()
    {
        return self::all()->last()->id;
    }

    public static function getRecordsAfterLast(int $id)
    {
        return self::where('id','>',$id)->get(['id']);
    }
}
