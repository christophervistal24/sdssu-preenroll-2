<?php

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
    	   DB::table('rooms')->insert([
			[
				'room_number' => 401,
				'created_at' => date('Y-m-d H:i:s'),
			],
			[
				'room_number' => 402,
				'created_at' => date('Y-m-d H:i:s'),
			],
			[
				'room_number' => 403,
				'created_at' => date('Y-m-d H:i:s'),
			],
			[
				'room_number' => 404,
				'created_at' => date('Y-m-d H:i:s'),
			],
			[
				'room_number' => 405,
				'created_at' => date('Y-m-d H:i:s'),
			],
			[
				'room_number' => 406,
				'created_at' => date('Y-m-d H:i:s'),
			],
			[
				'room_number' => 407,
				'created_at' => date('Y-m-d H:i:s'),
			],
			[
				'room_number' => 501,
				'created_at' => date('Y-m-d H:i:s'),
			],
			[
				'room_number' => 502,
				'created_at' => date('Y-m-d H:i:s'),
			],
			[
				'room_number' => 503,
				'created_at' => date('Y-m-d H:i:s'),
			],
			[
				'room_number' => 504,
				'created_at' => date('Y-m-d H:i:s'),
			],
			[
				'room_number' => 505,
				'created_at' => date('Y-m-d H:i:s'),
			],
			[
				'room_number' => 601,
				'created_at' => date('Y-m-d H:i:s'),
			],
			[
				'room_number' => 602,
				'created_at' => date('Y-m-d H:i:s'),
			],
			[
				'room_number' => 603,
				'created_at' => date('Y-m-d H:i:s'),
			],
			[
				'room_number' => 604,
				'created_at' => date('Y-m-d H:i:s'),
			],
       	   ]);
    }
}
