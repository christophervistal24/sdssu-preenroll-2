<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
   public function getCurrentSemester()
   {
   		return $this->where('current',1)->first()->semester;
   }
}
