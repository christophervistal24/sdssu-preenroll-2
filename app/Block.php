<?php

namespace App;


use App\InstructorSchedule;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = ['course','no_of_enrolled','block_name','block_limit','level','status'];

    protected $events = [
        'updated' => UpdateBlock::class,
    ];

    public function blockMatch(string $block) :int
    {
        $matchThese = [
            'level'      => $block[0],
            'course'     => $block[1] . $block[2],
            'block_name' => $block[3],
        ];
        return $this->where($matchThese)->first()->id;
    }

    public function schedule()
    {
        return $this->hasMany(Schedule::class,'block');
    }



}
