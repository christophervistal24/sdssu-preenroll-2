<?php

namespace App\Http\Requests;

use App\Rules\ValidScheduleUpdate;
use App\Schedule;
use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequestUpdate extends FormRequest
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
            'start_time' => ['required' , new ValidScheduleUpdate(new Schedule)],
            'subject_id' => 'required',
            'end_time'   => 'required',
            'days'       => 'required',
            'room'       => 'required',
            'block'      => 'required'
        ];
    }
}
