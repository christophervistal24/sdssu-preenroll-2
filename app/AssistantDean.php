<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssistantDean extends Model
{
     protected $table = 'assistant_deans';
    protected $fillable = ['name','education_qualification','status','mobile_number','active','profile'];
    protected $primaryKey = 'id_number';
}
