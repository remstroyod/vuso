<?php

namespace Frontend\Http\Requests\Profile;

use Frontend\Rules\PhoneExist;
use Frontend\Rules\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $phone
 * @property string $newPhone
 * @property string $password
 * @property string $newPassword
 */
class CheckSmsRequest extends FormRequest
{
    const PASSWORD_RULE = 'required|min:8|max:16|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-_]).{6,}$/';

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
        $rules = [];

        if ($this->input('password')) {
            $rules['password'] = self::PASSWORD_RULE;

            if ($this->user() && $this->user()->password) {
                $rules['password'] = self::PASSWORD_RULE . '|current_password';
                $rules['newPassword'] = self::PASSWORD_RULE;
            }
        }

        if ($this->input('phone')) {
            $rules['phone'] = ['required', new PhoneNumber, new PhoneExist];
        }

        if (!$this->input('phone') && !$this->input('password')) {
            $rules['phone'] = ['required', new PhoneNumber, new PhoneExist];
        }

        return $rules;
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
            'password.min' => __('Минимальное количество символов').' 8',
            'password.max' => __('Максимальное количество символов').' 16',
            'password.regex' => __('Пароль не соответствует правилу'),
            'password.current_password' => __('Вы ввели неверный пароль'),
            'newPassword.required' => __('Вы не ввели пароль'),
            'newPassword.min' => __('Минимальное количество символов').' 8',
            'newPassword.max' => __('Максимальное количество символов').' 16',
            'newPassword.regex' => __('Пароль не соответствует правилу'),
            'phone.required' => __( 'Пожалуйста, укажите свой номер телефона' )
        ];

    }
}
