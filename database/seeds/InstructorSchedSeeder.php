<?php

use App\Subject;
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
							'subject_id'=> Subject::where('sub_description','Introduction Computing')->first()->id,
							'block' => 1
       				],
       				[
							'start_time' => '7:30 AM',
							'end_time'   => '8:30 AM',
							'days'       => 'TTH',
							'room'       => '401',
							'subject_id'=> Subject::where('sub_description','Introduction Computing')->first()->id,
							'block' => 1
       				],
       				[
							'start_time' => '7:30 AM',
							'end_time'   => '8:30 AM',
							'days'       => 'MWF',
							'room'       => '401',
							'subject_id'=> Subject::where('sub_description','Fundamental of Programming - C++')->first()->id,
							'block' => 1
       				],
       				[
							'start_time' => '7:30 AM',
							'end_time'   => '8:30 AM',
							'days'       => 'MWF',
							'room'       => '401',
							'subject_id'=> Subject::where('sub_description','Understanding the Self')->first()->id,
							'block' => 1
       				],
       				[
							'start_time' => '7:30 AM',
							'end_time'   => '8:30 AM',
							'days'       => 'MWF',
							'room'       => '401',
							'subject_id'=> Subject::where('sub_description','Mathematics in the Modern World')->first()->id,
							'block' => 1
       				],
       				[
							'start_time' => '7:30 AM',
							'end_time'   => '8:30 AM',
							'days'       => 'MWF',
							'room'       => '401',
							'subject_id'=> Subject::where('sub_description','Purposive Communication')->first()->id,
							'block' => 1
       				],
       				[
							'start_time' => '7:30 AM',
							'end_time'   => '8:30 AM',
							'days'       => 'MWF',
							'room'       => '401',
							'subject_id'=> Subject::where('sub_description','Kontekstwalisadong Komunikasyon sa Filipino')->first()->id,
							'block' => 1
       				],
       				[
							'start_time' => '7:30 AM',
							'end_time'   => '8:30 AM',
							'days'       => 'MWF',
							'room'       => '401',
							'subject_id'=> Subject::where('sub_description','Living in the IT Era')->first()->id,
							'block' => 1
       				],
       				[
							'start_time' => '7:30 AM',
							'end_time'   => '8:30 AM',
							'days'       => 'MWF',
							'room'       => '401',
							'subject_id'=> Subject::where('sub_description','Physical Fitness & Health')->first()->id,
							'block' => 1
       				],
       				[
							'start_time' => '7:30 AM',
							'end_time'   => '8:30 AM',
							'days'       => 'MWF',
							'room'       => '401',
							'subject_id'=> Subject::where('sub_description','National Service Training Program 1')->first()->id,
							'block' => 1
       				],
       				[
							'start_time' => '7:30 AM',
							'end_time'   => '8:30 AM',
							'days'       => 'MWF',
							'room'       => '401',
							'subject_id'=> Subject::where('sub_description','Human Computer Interaction')->first()->id,
							'block' => 4
       				],
       				[
							'start_time' => '7:30 AM',
							'end_time'   => '8:30 AM',
							'days'       => 'MWF',
							'room'       => '401',
							'subject_id'=> Subject::where('sub_description','Individual and Dual Sports')->first()->id,
							'block' => 2
       				],
       				[
							'start_time' => '7:30 AM',
							'end_time'   => '8:30 AM',
							'days'       => 'MWF',
							'room'       => '401',
							'subject_id'=> Subject::where('sub_description','Art Appreciation')->first()->id,
							'block' => 2
       				],
       				[
							'start_time' => '7:30 AM',
							'end_time'   => '8:30 AM',
							'days'       => 'MWF',
							'room'       => '401',
							'subject_id'=> Subject::where('sub_description','Embedded systems')->first()->id,
							'block' => 2
       				],
       				[
							'start_time' => '7:30 AM',
							'end_time'   => '8:30 AM',
							'days'       => 'MWF',
							'room'       => '401',
							'subject_id'=> Subject::where('sub_description','Engineering 1')->first()->id,
							'block' => 5
       				],
       				[
							'start_time' => '7:30 AM',
							'end_time'   => '8:30 AM',
							'days'       => 'MWF',
							'room'       => '401',
							'subject_id'=> Subject::where('sub_description','Engineering 2')->first()->id,
							'block' => 5
       				],
       				[
							'start_time' => '7:30 AM',
							'end_time'   => '8:30 AM',
							'days'       => 'MWF',
							'room'       => '401',
							'subject_id'=> Subject::where('sub_description','Engineering 3')->first()->id,
							'block' => 6
       				],

       			]);

       	}
}
