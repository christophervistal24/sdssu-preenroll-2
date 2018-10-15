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
							'instructor' => 'Erlina M. Ravelo',
							'subject' => 'Introduction Computing',
							'block' => '1CSA'
       				],
       				[
							'start_time' => '7:30 AM',
							'end_time'   => '8:30 AM',
							'days'       => 'MWF',
							'room'       => '401',
							'instructor' => 'Erlina M. Ravelo',
							'subject' => 'Fundamental of Programming - C++',
							'block' => '1CSA'
       				],
       				[
							'start_time' => '7:30 AM',
							'end_time'   => '8:30 AM',
							'days'       => 'MWF',
							'room'       => '401',
							'instructor' => 'Erlina M. Ravelo',
							'subject' => 'Understanding the Self',
							'block' => '1CSA'
       				],
       				[
							'start_time' => '7:30 AM',
							'days'       => 'MWF',
							'room'       => '401',
							'instructor' => 'Erlina M. Ravelo',
							'subject' => 'Mathematics in the Modern World',
							'block' => '1CSA'
       				],
       				[
							'start_time' => '7:30 AM',
							'end_time'   => '8:30 AM',
							'days'       => 'MWF',
							'room'       => '401',
							'instructor' => 'Erlina M. Ravelo',
							'subject' => 'Purposive Communication',
							'block' => '1CSA'
       				],
       				[
							'start_time' => '7:30 AM',
							'end_time'   => '8:30 AM',
							'days'       => 'MWF',
							'room'       => '401',
							'instructor' => 'Erlina M. Ravelo',
							'subject' => 'Kontekstwalisadong Komunikasyon sa Filipino',
							'block' => '1CSA'
       				],
       				[
							'start_time' => '7:30 AM',
							'end_time'   => '8:30 AM',
							'days'       => 'MWF',
							'room'       => '401',
							'instructor' => 'Erlina M. Ravelo',
							'subject' => ' 	Living in the IT Era',
							'block' => '1CSA'
       				],
       				[
							'start_time' => '7:30 AM',
							'end_time'   => '8:30 AM',
							'days'       => 'MWF',
							'room'       => '401',
							'instructor' => 'Erlina M. Ravelo',
							'subject' => 'Physical Fitness & Health',
							'block' => '1CSA'
       				],
       				[
							'start_time' => '7:30 AM',
							'end_time'   => '8:30 AM',
							'days'       => 'MWF',
							'room'       => '401',
							'instructor' => 'Erlina M. Ravelo',
							'subject' => 'National Service Training Program 1',
							'block' => '1CSA'
       				],


       			]);
    }
}
