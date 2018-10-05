<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    protected $fillable = [
        'name', 'id_number', 'password','education_qualification',
        'major','status'
    ];
}
