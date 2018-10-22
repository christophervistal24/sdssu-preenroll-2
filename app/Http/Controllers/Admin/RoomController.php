<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Room;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        return view('admins.listrooms',compact('rooms'));
    }

    public function store()
    {
        $request->validate([
            'room_number' => 'required|unique:rooms'
        ]);
        $room = Room::find($request->id);
        if (!$room) {
            Room::create([
              'room_number' => $request->room_number,
            ]);
        } else {
            $room->room_number = $request->room_number;
            $room->save();
        }
    }

    public function delete(Room $room)
    {
        $room->delete();
        return redirect()->back()->with('status', 'Successfully delete a room');
    }
}
