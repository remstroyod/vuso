<?php

namespace Backend\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PagesRequest extends FormRequest
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
            'name'          => 'required|max:255',
            'page'          => 'regex:/^[a-z0-9\-]+$/i',
            'is_active'     => 'integer',
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
            'name.required' => 'Поле Наименование не может быть пустым',
            'name.max' => 'Максимальное количество символов 255',
            'page.regex' => 'Разрешены только буквы, цифры и тире',
        ];

    }

}