<?php

use App\Room;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$room = new Room();
    	$room->room_number = 401;
    	$room->save();

    	$room = new Room();
    	$room->room_number = 402;
    	$room->save();

    	$room = new Room();
    	$room->room_number = 403;
    	$room->save();

    	$room = new Room();
    	$room->room_number = 404;
    	$room->save();

    	$room = new Room();
    	$room->room_number = 405;
    	$room->save();

    	$room = new Room();
    	$room->room_number = 406;
    	$room->save();

    	$room = new Room();
    	$room->room_number = 407;
    	$room->save();

    	$room = new Room();
    	$room->room_number = 501;
    	$room->save();

    	$room = new Room();
    	$room->room_number = 502;
    	$room->save();

    	$room = new Room();
    	$room->room_number = 503;
    	$room->save();

    	$room = new Room();
    	$room->room_number = 504;
    	$room->save();

    	$room = new Room();
    	$room->room_number = 505;
    	$room->save();

    	$room = new Room();
    	$room->room_number = 601;
    	$room->save();

    	$room = new Room();
    	$room->room_number = 602;
    	$room->save();

    	$room = new Room();
    	$room->room_number = 603;
    	$room->save();

    	$room = new Room();
    	$room->room_number = 604;
    	$room->save();
    }
}
