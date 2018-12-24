<?php

namespace App\Rules;

use App\Schedule;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;

class ValidSchedule implements Rule
{
    protected $schedule;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Schedule $schedule)
    {
        $this->schedule = $schedule;
    }

    /**
     * Determine if the validation rule passes.
     * if the result is true meaning the schedule is already exists
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return ($this->schedule->isInBetweenOfSchedule()->isExists()) ? false : true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This schedule is conflict to other schedules , please check all schedules';
    }
}
