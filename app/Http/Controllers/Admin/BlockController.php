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
        $blocks = $this->block //get all blocks
                         ->orderBy('created_at')
                        ->get();
        return view('admins.listblocks',compact('blocks'));
    }


    public function store(StoreBlock $request)
    {
        $this->block
             ->create(
                [
                    'block_limit'    => $request->block_limit,
                    'no_of_enrolled' => 0,
                    'block_name'     =>  $request->block_name,
                    'course'         =>  $request->course,
                    'year'           =>  $request->year,
               ]
        );

        return response()->json(['success' => true]);
    }

    public function update(Request $request)
    {
        $this->block
             ->findOrFail($request->block_id)
             ->update([
                    'course'      => $request->course,
                    'block_name'  => strtoupper($request->block_name),
                    'block_limit' => $request->block_limit,
                    'level'       => $request->year,
                ]);
              \Event::fire( new UpdateBlock(new Block,$request->block_id));
        return response()->json(['success' => true]);
    }

    public function retrieveblock()
    {
        return $this->block->orderBy('created_at')
                        ->where('status','open')
                        ->get()
                        ->toArray();
    }

}
