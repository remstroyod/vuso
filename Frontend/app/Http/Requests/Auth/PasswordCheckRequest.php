<?php

namespace Frontend\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class PasswordCheckRequest extends FormRequest
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
            'password' => 'required',
        ];

    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {

        return [
            'password.required' => __('Вы не ввели пароль'),
        ];

    }

}
