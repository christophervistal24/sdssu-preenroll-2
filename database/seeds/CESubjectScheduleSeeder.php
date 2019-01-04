<?php

use App\Schedule;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CESubjectScheduleSeeder extends Seeder
{
     private  $start_time = [
            '7:00 AM','8:00 AM','9:00 AM','10:00 AM',
            '11:00 AM','12:00 PM','1:00 PM','2:00 PM',
            '3:00 PM','4:00 PM','5:00 PM',
        ];

   private  $end_time = [
            '8:00 AM','9:00 AM','10:00 AM','11:00 AM',
            '12:00 AM','1:00 PM','2:00 PM','3:00 PM',
            '4:00 PM','5:00 PM','6:00 PM',
        ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $first_year_first_semester = [55,56,57,58,59,60,61,62,63];
        foreach ($first_year_first_semester as $key => $subject_id) {
            Schedule::create([
                'start_time' => $this->start_time[$key],
                'end_time' => $this->end_time[$key],
                'days'       => 'MWF',
                'room'       => '401',
                'subject_id'=>  $subject_id,
                'block' => 5
            ]);
        }

        $first_year_second_semester = [64,65,66,67,68,69,70,71];
        foreach ($first_year_second_semester as $key => $subject_id) {
            Schedule::create([
                'start_time' => $this->start_time[$key],
                'end_time' => $this->end_time[$key],
                'days'       => 'MWF',
                'room'       => '401',
                'subject_id'=>  $subject_id,
                'block' => 5
            ]);
        }

        $second_year_first_semester = [72,73,74,75,76,77,78,79];
        foreach ($second_year_first_semester as $key => $subject_id) {
            Schedule::create([
                'start_time' => $this->start_time[$key],
                'end_time' => $this->end_time[$key],
                'days'       => 'MWF',
                'room'       => '401',
                'subject_id'=>  $subject_id,
                'block' => 6
            ]);
        }

        $second_year_second_semester = [80,81,82,83,84,85,86,87];
        foreach ($second_year_second_semester as $key => $subject_id) {
            Schedule::create([
                'start_time' => $this->start_time[$key],
                'end_time' => $this->end_time[$key],
                'days'       => 'MWF',
                'room'       => '401',
                'subject_id'=>  $subject_id,
                'block' => 6
            ]);
        }

        $third_year_first_semester = [88,86,87,88,89,90,91,92,93,94,95];
        foreach ($third_year_first_semester as $key => $subject_id) {
            Schedule::create([
                'start_time' => $this->start_time[$key],
                'end_time' => $this->end_time[$key],
                'days'       => 'MWF',
                'room'       => '401',
                'subject_id'=>  $subject_id,
                'block' => 7
            ]);
        }

        $third_year_second_semester = range(96,102);
        foreach ($third_year_second_semester as $key => $subject_id) {
            Schedule::create([
                'start_time' => $this->start_time[$key],
                'end_time' => $this->end_time[$key],
                'days'       => 'MWF',
                'room'       => '401',
                'subject_id'=>  $subject_id,
                'block' => 7
            ]);
        }

        $fourth_year_first_semester = range(103,109);
        foreach ($fourth_year_first_semester as $key => $subject_id) {
            Schedule::create([
                'start_time' => $this->start_time[$key],
                'end_time'   => $this->end_time[$key],
                'days'       => 'MWF',
                'room'       => '401',
                'subject_id'=>  $subject_id,
                'block' => 8
            ]);
        }

        $fourth_year_second_semester = range(110,116);
        foreach ($fourth_year_second_semester as $key => $subject_id) {
            Schedule::create([
                'start_time' => $this->start_time[$key],
                'end_time' => $this->end_time[$key],
                'days'       => 'MWF',
                'room'       => '401',
                'subject_id'=>  $subject_id,
                'block' => 8
            ]);
        }

        $fifth_year_first_semester = range(118,123);
        foreach ($fifth_year_first_semester as $key => $subject_id) {
            Schedule::create([
                'start_time' => $this->start_time[$key],
                'end_time' => $this->end_time[$key],
                'days'       => 'MWF',
                'room'       => '401',
                'subject_id'=>  $subject_id,
                'block' => 9
            ]);
        }

        $fifth_year_second_semester = range(124,128);
        foreach ($fifth_year_second_semester as $key => $subject_id) {
            Schedule::create([
                'start_time' => $this->start_time[$key],
                'end_time' => $this->end_time[$key],
                'days'       => 'MWF',
                'room'       => '401',
                'subject_id'=>  $subject_id,
                'block' => 9
            ]);
        }



    }

}
