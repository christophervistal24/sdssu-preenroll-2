<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Schedule;
use Carbon\Carbon;

class InsertSecondSemFourthYear extends Command
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
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fo2';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert all fourth year second sem schedules';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
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

         $this->info("Successfully insert all fourth year second sem. schedules");
    }
}
