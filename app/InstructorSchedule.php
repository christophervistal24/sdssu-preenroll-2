<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstructorSchedule extends Model
{
   public $fillable = ['start_time','end_time','days','room','subject','instructor'];
}
