<?php

namespace App\Http\Requests\AppointingArchitect;

use Illuminate\Foundation\Http\FormRequest;

class StepTwoRequest extends FormRequest
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
            'application_info_and_its_enclosures_verify' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'application_info_and_its_enclosures_verify.required' => 'The application info and its enclosures acceptance is required',
        ];
    }
}
