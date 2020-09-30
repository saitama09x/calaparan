<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentValidator extends FormRequest
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
            'fname' => 'required',
            'lname' => 'required',
            'mname' => 'required',
            'bday' => 'required',
            'sex' => 'required',
        ];
    }


    public function messages()
    {
        return [
            'fname.required' => 'First Name',
            'lname.required'  => 'Last Name',
            'mname.required' => 'Middle Name',
            'bday.required' => 'Birthday',
            'sex.required' => 'Gender'
        ];
    }
}
