<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    private static $max_student = 45;
    protected $fillable = ['course','no_of_enrolled','block_name','level'];

    public static function getNoOfEnrolled($year_level)
    {
        $checkBlockIfFull = Block::where('level',$year_level)
                            ->orderBy('block_name','DESC')
                            ->get(['no_of_enrolled','block_name']);
        if ($checkBlockIfFull[0]->no_of_enrolled == self::$max_student) {
            //make it dynamic next time / static for now
            Block::create([
                'course'         => 'CS',
                'no_of_enrolled' => 0,
                'block_name'     => ++$checkBlockIfFull[0]->block_name,
                'level'          => $year_level,
            ]);
        }
    	return Block::where('level',$year_level)
    				->orderBy('block_name','DESC')
    				->get(['no_of_enrolled','block_name']);
    }
}
