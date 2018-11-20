<?php

use Illuminate\Database\Seeder;

class InstructorSchedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('schedules')
       			->insert([
       				[
							'start_time' => '7:30 AM',
							'end_time'   => '8:30 AM',
							'days'       => 'MWF',
							'room'       => '401',
							'subject' => 'Introduction Computing',
							'block' => 1
       				],
       				[
							'start_time' => '7:30 AM',
							'end_time'   => '8:30 AM',
							'days'       => 'MWF',
							'room'       => '401',
							'subject' => 'Fundamental of Programming - C++',
							'block' => 1
       				],
       				[
							'start_time' => '7:30 AM',
							'end_time'   => '8:30 AM',
							'days'       => 'MWF',
							'room'       => '401',
							'subject' => 'Understanding the Self',
							'block' => 1
       				],
       				[
							'start_time' => '7:30 AM',
							'end_time'   => '8:30 AM',
							'days'       => 'MWF',
							'room'       => '401',
							'subject' => 'Mathematics in the Modern World',
							'block' => 1
       				],
       				[
							'start_time' => '7:30 AM',
							'end_time'   => '8:30 AM',
							'days'       => 'MWF',
							'room'       => '401',
							'subject' => 'Purposive Communication',
							'block' => 1
       				],
       				[
							'start_time' => '7:30 AM',
							'end_time'   => '8:30 AM',
							'days'       => 'MWF',
							'room'       => '401',
							'subject' => 'Kontekstwalisadong Komunikasyon sa Filipino',
							'block' => 1
       				],
       				[
							'start_time' => '7:30 AM',
							'end_time'   => '8:30 AM',
							'days'       => 'MWF',
							'room'       => '401',
							'subject' => ' 	Living in the IT Era',
							'block' => 1
       				],
       				[
							'start_time' => '7:30 AM',
							'end_time'   => '8:30 AM',
							'days'       => 'MWF',
							'room'       => '401',
							'subject' => 'Physical Fitness & Health',
							'block' => 1
       				],
       				[
							'start_time' => '7:30 AM',
							'end_time'   => '8:30 AM',
							'days'       => 'MWF',
							'room'       => '401',
							'subject' => 'National Service Training Program 1',
							'block' => 1
       				],
       				[
							'start_time' => '7:30 AM',
							'end_time'   => '8:30 AM',
							'days'       => 'MWF',
							'room'       => '401',
							'subject' => 'Human Computer Interaction',
							'block' => 4
       				],

       			]);

       	}
}
