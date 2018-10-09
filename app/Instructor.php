<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    protected $fillable = ['id_number','name','education_qualification','position','status','mobile_number','active'];
}
