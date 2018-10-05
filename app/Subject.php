<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public $timestamp = false;
    protected $fillable = [
    	'course','year','sub','sub_description',
    	'units','prereq'
	];
}
