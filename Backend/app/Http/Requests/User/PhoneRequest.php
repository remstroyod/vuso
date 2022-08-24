<?php

namespace Backend\Http\Requests\User;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;

class PhoneRequest extends FormRequest
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
                'phone' => [Rule::when(request()->has('phone') && !empty(request()->has('phone')), 'required|integer|digits_between:12,12')],
                //'phone' => '',
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
            'phone.required' => __( 'Пожалуйста, укажите номер телефона' ),
            'phone.digits_between' => __( 'Число символов не соответствует формату 380xxxxxxxxx' ),
            'phone.integer' => __( 'Неверный формат телефона. Формат должен быть 380xxxxxxxxx' ),
        ];

    }

    protected function failedValidation(Validator $validator)
    {
        $response = redirect()
                ->route('users.orders.index')
                ->withErrors($validator);
        
        throw (new ValidationException($validator, $response))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }

}
