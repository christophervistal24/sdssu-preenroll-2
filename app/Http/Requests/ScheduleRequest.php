<?php

namespace App\Http\Requests;
use App\Rules\ValidSchedule;
use App\Schedule;
use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'start_time' => ['required' , new ValidSchedule(new Schedule)],
            'end_time'   => 'required',
            'days'       => 'required',
            'room'       => 'required',
            'subject_id' => 'required',
            'block'      => 'required'
        ];
    }
}
