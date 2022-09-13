<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;



class CollegeRegisterRequest extends FormRequest
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
            'college_name' => ['required', 'string', 'max:255', 'min:6'],
            'college_shorthand' => ['required', 'string', 'max:25', 'min:3'],
        ];
    }
}
