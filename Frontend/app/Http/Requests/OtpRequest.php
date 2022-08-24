<?php

namespace Frontend\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class OtpRequest extends FormRequest
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
            'phone' => 'required',
            'code' => 'required|numeric|min:2',
        ];

    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation Errors',
            'data'      => $validator->errors()
        ]));
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {

        return [
            'code.required' => 'Не передан код ОТП',
            'code.numeric' => 'ОТП должен состоять только из цифр',
            'code.min' => 'Минимальное кол.-во символов ОТП 2',
            'phone.required' => 'Не передан номер телефона',
        ];

    }

}
