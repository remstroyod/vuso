<?php

namespace Backend\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
            'name'      => 'required|max:30',
            'email'     => 'required|email|max:255|unique:users',
            'password'  => 'required|min:6'
        ];
    }

}
