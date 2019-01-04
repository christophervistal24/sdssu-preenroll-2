<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstructorScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('instructor_schedule')
                        ->insert([
                            [
                                'instructor_id_number' => 1,
                                'schedule_id' => 77,
                                'created_at' => Carbon::now(),
                            ],
                            [
                                'instructor_id_number' => 1,
                                'schedule_id' => 78,
                                'created_at' => Carbon::now(),

                            ],
                            [
                                'instructor_id_number' => 1,
                                'schedule_id' => 79,
                                'created_at' => Carbon::now(),
                            ],
                            [
                                'instructor_id_number' => 1,
                                'schedule_id' => 80,
                                'created_at' => Carbon::now(),
                            ],
                            [
                                'instructor_id_number' => 1,
                                'schedule_id' => 81,
                                'created_at' => Carbon::now(),
                            ],
                            [
                                'instructor_id_number' => 1,
                                'schedule_id' => 82,
                                'created_at' => Carbon::now(),
                            ],
                            [
                                'instructor_id_number' => 1,
                                'schedule_id' => 83,
                                'created_at' => Carbon::now(),
                            ],
                            [
                                'instructor_id_number' => 1,
                                'schedule_id' => 84,
                                'created_at' => Carbon::now(),
                            ],
                            [
                                'instructor_id_number' => 1,
                                'schedule_id' => 85,
                                'created_at' => Carbon::now(),
                            ],

                        ]);
    }
}
