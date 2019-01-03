<?php

namespace App\Http\Controllers\Admin;

use App\Block;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlock;
use Illuminate\Http\Request;
use App\Events\UpdateBlock;

class BlockController extends Controller
{
    protected $block;

    public function __construct(Block $block)
    {
        $this->block = $block;
    }

    public function index()
    {
        $blocks = $this->block->get();
        return view('admins.listblocks',compact('blocks'));
    }


    public function store(StoreBlock $request)
    {
        $this->block->create($request->all());
        return response()->json(['success' => true]);
    }

    public function update(Request $request)
    {
        $fields = $request->except(['_token','year','block_id']);
        $this->block->where('id',$request->block_id)->update($fields);

        //fire an event this will check if the no. of students enrolled reach
        //the maximum so the block will automatically closed
        \Event::fire( new UpdateBlock(new Block,$request->block_id));
        return response()->json(['success' => true]);
    }

    public function retrieveblock()
    {
        //for displaying real-time
        //this is not the good way to display a data in real-time
        return $this->block->get()->toArray();
    }

}
