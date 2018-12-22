<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Role extends Model
{
    use Cachable;
    public function users()
    {
    	return $this->belongsToMany('App\User','user_role','role_id','user_id');
    }
}
