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
        Room::create(['room_number' => $request->room_number]);
        return response()->json(['success' => true]);
/*        } else {

        }*/
    }

    public function update(RoomRequest $request)
    {
        Room::find($request->action)->update(['room_number' => $request->room_number]);
        return response()->json(['success' => true]);
    }

    public function delete(Room $room)
    {
        $room->delete();
        return response()->json(['success' => true]);
    }
}
