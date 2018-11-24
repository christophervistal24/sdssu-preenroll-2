<?php

namespace App\Http\Controllers\Admin;

use App\Block;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlock;
use Illuminate\Http\Request;

class BlockController extends Controller
{
    public function index()
    {
        $blocks = Block::all();
        return view('admins.listblocks',compact('blocks'));
    }

    public function store(StoreBlock $request)
    {
        Block::create([
            'block_limit'    => $request->block_limit,
            'no_of_enrolled' => 0,
            'block_name'     =>  $request->block_name,
            'course'         =>  $request->course,
            'year'           =>  $request->year,
        ]);

        return response()->json(['success' => true]);
    }

    public function update(Request $request)
    {
        Block::findOrFail($request->block_id)->update([
                'course'      => $request->course,
                'block_name'  => strtoupper($request->block_name),
                'block_limit' => $request->block_limit,
                'level'       => $request->year,
        ]);
        return response()->json(['success' => true]);
    }

}
