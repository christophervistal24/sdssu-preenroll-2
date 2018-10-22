<?php

namespace App;


use App\InstructorSchedule;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    protected $fillable = ['course','no_of_enrolled','block_name','block_limit','level','status'];

    public static function checkifBlockIsAvailable($data = [])
    {
         $blockMatch = [
            'level'      => $data['level'],
            'block_name' => $data['block_name'],
            'course'     => $data['course'],
        ];
        $getBlock       = Block::where($blockMatch)->first();
        if (!isset($data['action_from']) or $data['action_from'] != 'submitblock') {
            $getBlock->increment('no_of_enrolled');
        }
        $block_limit    = $getBlock->block_limit;
        $no_of_enrolled = $getBlock->no_of_enrolled;
        if ($no_of_enrolled >= $block_limit) {
            $getBlock->status = 'closed';
            $getBlock->save();
            InstructorSchedule::where('block',$getBlock->level . $getBlock->course . $getBlock->block_name)
                                ->update(['status' => 'delete']);
        } else {
            $getBlock->status = 'open';
            $getBlock->save();
            InstructorSchedule::where('block',$getBlock->level . $getBlock->course . $getBlock->block_name)
                                ->update(['status' => 'active']);
        }
    }


}
