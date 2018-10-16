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
       DB::table('instructor_schedules')
       			->insert([
       				[
							'start_time' => '7:30 AM',
							'end_time'   => '8:30 AM',
							'days'       => 'MWF',
							'room'       => '401',
							'instructor' => null,
							'subject' => 'Introduction Computing',
							'block' => '1CSA'
       				],
       				[
							'start_time' => '7:30 AM',
							'end_time'   => '8:30 AM',
							'days'       => 'MWF',
							'room'       => '401',
							'instructor' => null,
							'subject' => 'Fundamental of Programming - C++',
							'block' => '1CSA'
       				],
       				[
							'start_time' => '7:30 AM',
							'end_time'   => '8:30 AM',
							'days'       => 'MWF',
							'room'       => '401',
							'instructor' => null,
							'subject' => 'Understanding the Self',
							'block' => '1CSA'
       				],
       				[
							'start_time' => '7:30 AM',
							'end_time'   => '8:30 AM',
							'days'       => 'MWF',
							'room'       => '401',
							'instructor' => null,
							'subject' => 'Mathematics in the Modern World',
							'block' => '1CSA'
       				],
       				[
							'start_time' => '7:30 AM',
							'end_time'   => '8:30 AM',
							'days'       => 'MWF',
							'room'       => '401',
							'instructor' => null,
							'subject' => 'Purposive Communication',
							'block' => '1CSA'
       				],
       				[
							'start_time' => '7:30 AM',
							'end_time'   => '8:30 AM',
							'days'       => 'MWF',
							'room'       => '401',
							'instructor' => null,
							'subject' => 'Kontekstwalisadong Komunikasyon sa Filipino',
							'block' => '1CSA'
       				],
       				[
							'start_time' => '7:30 AM',
							'end_time'   => '8:30 AM',
							'days'       => 'MWF',
							'room'       => '401',
							'instructor' => null,
							'subject' => ' 	Living in the IT Era',
							'block' => '1CSA'
       				],
       				[
							'start_time' => '7:30 AM',
							'end_time'   => '8:30 AM',
							'days'       => 'MWF',
							'room'       => '401',
							'instructor' => null,
							'subject' => 'Physical Fitness & Health',
							'block' => '1CSA'
       				],
       				[
							'start_time' => '7:30 AM',
							'end_time'   => '8:30 AM',
							'days'       => 'MWF',
							'room'       => '401',
							'instructor' => null,
							'subject' => 'National Service Training Program 1',
							'block' => '1CSA'
       				],

       			]);
    }
}
