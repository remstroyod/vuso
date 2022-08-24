<?php

namespace Frontend\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class ObjInsuranceBuildingRequest extends FormRequest
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
            'address' => 'nullable|regex:/^[А-Яа-яЁё]/u',
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
            'address.regex' => 'Введите адрес на Кириллицу',
        ];

    }

}
