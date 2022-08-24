<?php

namespace Frontend\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class ObjInsuranceCarRequest extends FormRequest
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
            'vin' => 'required|between:17,17|regex:/^[a-zA-Z0-9]+$/',
            'run' => 'nullable|numeric|min:1',
            'reg_num' => 'nullable|regex:/^[а-щА-ЩЬьЮюЯяЇїІіЄєҐґ]{2}[ ]?[0-9]{4}[ ]?[а-щА-ЩЬьЮюЯяЇїІіЄєҐґ]{2}+$/u',
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
            'vin.required' => 'Пожалуйста, укажите Номер кузова (VIN код)',
            'vin.between' => 'Номер кузова (VIN код) должно быть 17 символ',
            'vin.regex' => 'Номер кузова (VIN код) должно быть латинских букв и цифр',
            'run.min' => 'Пробег – не может быть равно 0',
            'reg_num.regex' => 'Неверный формат. Гос номер должно быть например таким АС 1234 ГЕ или АС1234ГЕ',
        ];

    }

}
