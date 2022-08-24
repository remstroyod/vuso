<?php

namespace Frontend\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class ObjInsurancePersonRequest extends FormRequest
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
            'international_passport' => 'nullable|between:9,9|regex:/^[a-zA-Z]{2}[0-9]{7}+$/',
            'INN' => 'nullable|between:10,10',
            'ukr_passport' => 'nullable|between:9,9',
            'last_name' => 'nullable|min:2|max:20|regex:/[А-Яа-яЁё]/u',
            'first_name' => 'nullable|min:2|max:20|regex:/[А-Яа-яЁё]/u',
            'middle_name' => 'nullable|min:2|max:20',
            'mail' => 'nullable|email',
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
            'international_last_name.regex' => 'Введите фамилию в загранпаспорте на Латински',
            'international_first_name.regex' => 'Введите имя в загранпаспорте на Латински',
            'international_passport.between' => 'Загранпаспорт должно быть 9 символ',
            'identification_number.between' => 'ИНН должно быть 10 символ',
            'passport_id.between' => 'Номер паспорта должно быть 9 символ',
            'international_passport.regex' => 'Неверный формат. Загранпаспорт должно быть например таким AB0000000',
            'last_name.required' => 'Заполните поле Имя',
            'last_name.regex' => 'Введите имя на Кириллицу',
            'first_name.regex' => 'Введите имя на Кириллицу',
            'first_name.required' => 'Заполните поле Имя',
            'middle_name.required' => 'Заполните поле Имя',
            'email.required' => 'Заполните поле E-mail',
            'email.email' => 'Неверный формат',
        ];

    }

}
