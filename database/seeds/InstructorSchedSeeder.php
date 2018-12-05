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
							'end_time'   => '9:00 AM',
							'days'       => 'MWF',
							'room'       => '401',
							'subject_id'=> Subject::where('sub_description','Introduction Computing')->first()->id,
							'block' => 1
       				],
       				[
							'start_time' => '9:00 AM',
							'end_time'   => '10:00 AM',
							'days'       => 'TTH',
							'room'       => '401',
							'subject_id'=> Subject::where('sub_description','Introduction Computing')->first()->id,
							'block' => 1
       				],
       				[
							'start_time' => '10:00 AM',
							'end_time'   => '12:00 PM',
							'days'       => 'MWF',
							'room'       => '401',
							'subject_id'=> Subject::where('sub_description','Fundamental of Programming - C++')->first()->id,
							'block' => 1
       				],
       				[
							'start_time' => '1:00 PM',
							'end_time'   => '2:00 PM',
							'days'       => 'MWF',
							'room'       => '401',
							'subject_id'=> Subject::where('sub_description','Understanding the Self')->first()->id,
							'block' => 1
       				],
       				[
							'start_time' => '2:00 PM',
							'end_time'   => '3:00 PM',
							'days'       => 'MWF',
							'room'       => '401',
							'subject_id'=> Subject::where('sub_description','Mathematics in the Modern World')->first()->id,
							'block' => 1
       				],
       				[
							'start_time' => '3:00 PM',
							'end_time'   => '4:00 PM',
							'days'       => 'MWF',
							'room'       => '401',
							'subject_id'=> Subject::where('sub_description','Purposive Communication')->first()->id,
							'block' => 1
       				],
       				[
							'start_time' => '4:00 PM',
							'end_time'   => '5:00 PM',
							'days'       => 'TTH',
							'room'       => '401',
							'subject_id'=> Subject::where('sub_description','Kontekstwalisadong Komunikasyon sa Filipino')->first()->id,
							'block' => 1
       				],
       				[
							'start_time' => '8:30 AM',
							'end_time'   => '10:30 AM',
							'days'       => 'TTH',
							'room'       => '401',
							'subject_id'=> Subject::where('sub_description','Living in the IT Era')->first()->id,
							'block' => 1
       				],
       				[
							'start_time' => '10:30 AM',
							'end_time'   => '12:00 PM',
							'days'       => 'TTH',
							'room'       => '401',
							'subject_id'=> Subject::where('sub_description','Physical Fitness & Health')->first()->id,
							'block' => 1
       				],
       				[
							'start_time' => '7:30 AM',
							'end_time'   => '12:00 AM',
							'days'       => 'S',
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

       				/*ENGINEERING SCHEDULES*/

       				[
							'start_time' => '7:30 AM',
							'end_time'   => '8:30 AM',
							'days'       => 'MWF',
							'room'       => '401',
							'subject_id'=> Subject::where('sub_description','General Chemistry 1')->first()->id,
							'block' => 6
       				],
       				[
							'start_time' => '7:30 AM',
							'end_time'   => '8:30 AM',
							'days'       => 'MWF',
							'room'       => '401',
							'subject_id'=> Subject::where('sub_description','Calculus with Analytic Geometry 1')->first()->id,
							'block' => 6
       				],
       			]);

				DB::table('instructor_schedule')
						->insert([
							[
								'instructor_id_number' => 1,
								'schedule_id' => 1,
							],
							[
								'instructor_id_number' => 1,
								'schedule_id' => 2,
							],
							[
								'instructor_id_number' => 1,
								'schedule_id' => 3,
							],
							[
								'instructor_id_number' => 1,
								'schedule_id' => 4,
							],
							[
								'instructor_id_number' => 1,
								'schedule_id' => 5,
							],
							[
								'instructor_id_number' => 1,
								'schedule_id' => 6,
							],
							[
								'instructor_id_number' => 1,
								'schedule_id' => 7,
							],
							[
								'instructor_id_number' => 1,
								'schedule_id' => 8,
							],
                            [
								'instructor_id_number' => 1,
								'schedule_id' => 9,
							],

						]);

       	}
}
