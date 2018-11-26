<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewStudent extends FormRequest
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
            'id_number'        => 'required|unique:students',
            'student_fullname' => 'required',
            'course'           => 'required',
            'address'          => 'required',
            'mobile_number'   => 'required|unique:students',
            'mothersname'      => 'required',
            'fathersname'      => 'required',
            'parent_mobile'    => 'required|unique:student_parents,mobile_number'
        ];
    }
}
