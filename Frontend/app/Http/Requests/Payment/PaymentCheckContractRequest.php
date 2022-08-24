<?php

namespace Frontend\Http\Requests\Payment;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class PaymentCheckContractRequest extends FormRequest
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
            'dogovor_id' => [
                'required',
                'min:5',
                'max:10',
                Rule::exists('edocument_users')->where(function ($query) {
                    return $query->where('dogovor_id', $this->dogovor_id)->where('total', '<>', 0);
                }),
            ],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation Errors',
            'errors'      => $validator->errors()
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
            'dogovor_id.required' => __( 'Укажите номер договора' ),
            'dogovor_id.min' => __( 'Минимальное кол.-во символов 5' ),
            'dogovor_id.max' => __( 'Максимальное кол.-во символов 10' ),
            'dogovor_id.exists' => __( 'Договор не найден' ),
        ];

    }

}
