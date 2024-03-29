<?php

namespace Backend\Http\Requests\Constructor;

use Illuminate\Foundation\Http\FormRequest;

class ConstructorRequest extends FormRequest
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
            'page'          => 'regex:~[\\\/:*?"\'<>|]~',
            'is_active'     => 'integer',
        ];
    }

    public function messages()
    {

        return [
            'name.required' => 'Вы не ввели наименование',
            'name.max' => 'Максимальное количество символов 255',
            'page.regex' => 'Обратный слэш запрещен',
        ];

    }

}
