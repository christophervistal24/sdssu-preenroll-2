<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Room extends Model
{
    use Cachable;
    protected $fillable = [
    	'room_number'
	];
}
