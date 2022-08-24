<?php

namespace Backend\Http\Requests\Ecommerce;

use Illuminate\Foundation\Http\FormRequest;

class PromocodeRequest extends FormRequest
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
            'name' => 'required|max:255',
            'reward' => 'numeric',
            'quantity' => 'numeric',
            'amount' => 'numeric',
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
            'reward.numeric' => 'Допустимы только числовые значения',
            'quantity.numeric' => 'Допустимы только числовые значения',
            'amount.numeric' => 'Допустимы только числовые значения',
        ];

    }

}
