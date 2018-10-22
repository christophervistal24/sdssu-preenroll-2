<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Block;

class BlockController extends Controller
{
    public function index()
    {
        $blocks = Block::all();
        return view('admins.listblocks',compact('blocks'));
    }

    public function store(Request $request)
    {
        if ($request->id != null) {
            //update block
            $this->update($request);
            return response()->json(['success' => true ]);
        } else {
            //create new block
             Block::create([
                'course'         => $request->course,
                'no_of_enrolled' => 0,
                'block_name'     => strtoupper($request->block_name),
                'block_limit'    => $request->block_limit,
                'level'          => $request->level
            ]);
            return response()->json(['success' => true]);
        }
    } 
    
    private function update(Request $request)
    {
        $block_information = Block::find($request->id);
        $block_information->course      = $request->course;
        $block_information->block_name  = strtoupper($request->block_name);
        $block_information->block_limit = $request->block_limit;
        $block_information->level       = $request->level;
        $block_information->save();
        Block::checkifBlockIsAvailable(
            [
                'level'       => $block_information->level,
                'block_name'  => $block_information->block_name,
                'course'      => $block_information->course,
                'action_from' => 'submitblock'
            ]
        );
    }

    

}
