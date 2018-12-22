<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomRequest;
use App\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        return view('admins.listrooms',compact('rooms'));
    }

    public function store(RoomRequest $request)
    {
        Room::create($request->all());
        return response()->json(['success' => true]);
    }

    public function update(RoomRequest $request)
    {
        Room::where('id',$request->action)
            ->update($request->except(['_token','action']));
        return response()->json(['success' => true]);
    }

    public function delete(Room $room)
    {
        $room->delete();
        return response()->json(['success' => true]);
    }
}
