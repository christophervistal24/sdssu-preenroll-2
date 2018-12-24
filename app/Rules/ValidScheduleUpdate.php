<?php

namespace App\Rules;

use App\Schedule;
use Illuminate\Contracts\Validation\Rule;

class ValidScheduleUpdate implements Rule
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
     * [firstValidate check if the schedule that the user want to update is itself]
     * @return [type] [description]
     */
    public function firstValidate()
    {
        //check if there's a schedule that match to user request
        if (is_null($this->schedule->isInBetweenOfSchedule()->first())) {
            return true;
        } else {
            return ($this->schedule->isInBetweenOfSchedule()->first()->id == request('schedule_id')) ? true : false;
        }

    }

    /**
     * [secondValidate check if there's a schedule that conflict to others]
     * @return [type] [description]
     */
    public function secondValidate()
    {
        return ($this->schedule->isInBetweenOfSchedule()->count() >= 2) ? false : true;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $first_validation = $this->firstValidate();
        $second_validation = $this->secondValidate();
        //check sum  for the validations
        $check_sum = (int) $first_validation + (int) $second_validation;
        return ($check_sum >= 2 ) ? true : false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
         return 'This schedule is conflict to other schedules';
    }
}
