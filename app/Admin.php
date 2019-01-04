<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admins';
    protected $fillable = ['name','education_qualification','status','mobile_number','active','profile'];
    protected $primaryKey = 'id_number';
    public $timestamps = false;

    public function getRouteKeyName()
    {
        return 'id_number';
    }

}
