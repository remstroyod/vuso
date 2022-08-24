<?php

namespace Frontend\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class PasswordStoreRequest extends FormRequest
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
            'password' => 'required|min:8|max:16|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-_]).{6,}$/',
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
            'password.min' => __('Минимальное количество символов 8'),
            'password.max' => __('Максимальное количество символов 16'),
            //'password.confirmed' => 'Пароли не совпадают',
            'password.regex' => __('Пароль не соответствует правилу'),
        ];

    }

}
