<?php

namespace Frontend\Http\Requests\Profile;

use Frontend\Rules\PhoneExist;
use Frontend\Rules\PhoneNumber;
use Frontend\Rules\UserConfirmCode;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $phone
 * @property string $newPhone
 * @property string $password
 * @property string $newPassword
 */
class SaveCodeRequest extends FormRequest
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
            'phone' => ['required', new PhoneNumber, new PhoneExist],
            'code' => ['required', new UserConfirmCode($this->user())]
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
            'phone.required' => __( 'Пожалуйста, укажите свой номер телефона' ),
            'code.required' => __( 'Пожалуйста, укажите код' ),
        ];

    }
}
