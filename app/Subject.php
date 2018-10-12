<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
    	'sub','sub_description','units','prereq','year','semester'
	];
}
