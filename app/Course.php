<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
	public function getCourse($id)
	{
		return $this->where('id',$id)->first();
	}
}
