<?php

use App\Schedule;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CSSubjectScheduleSeeder extends Seeder
{
    private  $start_time = [
            '7:00 AM','8:00 AM','9:00 AM','10:00 AM',
            '11:00 AM','12:00 PM','1:00 PM','2:00 PM',
            '3:00 PM','4:00 PM','5:00 PM',
        ];

   private  $end_time = [
            '8:00 AM','9:00 AM','10:00 AM','11:00 AM',
            '12:00 PM','1:00 PM','2:00 PM','3:00 PM',
            '4:00 PM','5:00 PM','6:00 PM',
        ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $first_year_first_semester = range(1,9);
        foreach ($first_year_first_semester as $key => $subject_id) {
            Schedule::create([
                'start_time' => Carbon::parse($this->start_time[$key]),
                'end_time' => Carbon::parse($this->end_time[$key]),
                'days'       => 'MWF',
                'room'       => '401',
                'subject_id'=>  $subject_id,
                'block' => 1
            ]);
        }

        $first_year_second_semester = range(10,18);
        foreach ($first_year_second_semester as $key => $subject_id) {
            Schedule::create([
                'start_time' => Carbon::parse($this->start_time[$key]),
                'end_time' => Carbon::parse($this->end_time[$key]),
                'days'       => 'MWF',
                'room'       => '401',
                'subject_id'=>  $subject_id,
                'block' => 1
            ]);
        }

        $second_year_first_semester = range(19,25);
        foreach ($second_year_first_semester as $key => $subject_id) {
            Schedule::create([
                'start_time' => Carbon::parse($this->start_time[$key]),
                'end_time' => Carbon::parse($this->end_time[$key]),
                'days'       => 'MWF',
                'room'       => '401',
                'subject_id'=>  $subject_id,
                'block' => 2
            ]);
        }

        $second_year_second_semester = range(26,32);
        foreach ($second_year_second_semester as $key => $subject_id) {
            Schedule::create([
                'start_time' => Carbon::parse($this->start_time[$key]),
                'end_time' => Carbon::parse($this->end_time[$key]),
                'days'       => 'MWF',
                'room'       => '401',
                'subject_id'=>  $subject_id,
                'block' => 2
            ]);
        }

        $third_year_first_semester = range(33,39);
        foreach ($third_year_first_semester as $key => $subject_id) {
            Schedule::create([
                'start_time' => Carbon::parse($this->start_time[$key]),
                'end_time' => Carbon::parse($this->end_time[$key]),
                'days'       => 'MWF',
                'room'       => '401',
                'subject_id'=>  $subject_id,
                'block' => 3
            ]);
        }

        $third_year_second_semester = range(40,45);
        foreach ($third_year_second_semester as $key => $subject_id) {
            Schedule::create([
                'start_time' => Carbon::parse($this->start_time[$key]),
                'end_time' => Carbon::parse($this->end_time[$key]),
                'days'       => 'MWF',
                'room'       => '401',
                'subject_id'=>  $subject_id,
                'block' => 3
            ]);
        }

        $fourth_year_first_semester = range(47,52);
        foreach ($fourth_year_first_semester as $key => $subject_id) {
            Schedule::create([
                'start_time' => Carbon::parse($this->start_time[$key]),
                'end_time' => Carbon::parse($this->end_time[$key]),
                'days'       => 'MWF',
                'room'       => '401',
                'subject_id'=>  $subject_id,
                'block' => 4
            ]);
        }

        $fourth_year_second_semester = range(53,54);
        foreach ($fourth_year_second_semester as $key => $subject_id) {
            Schedule::create([
                'start_time' => Carbon::parse($this->start_time[$key]),
                'end_time' => Carbon::parse($this->end_time[$key]),
                'days'       => 'MWF',
                'room'       => '401',
                'subject_id'=>  $subject_id,
                'block' => 4
            ]);
        }
    }
}
