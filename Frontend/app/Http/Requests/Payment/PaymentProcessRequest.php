<?php

namespace Frontend\Http\Requests\Payment;

use Illuminate\Foundation\Http\FormRequest;

class PaymentProcessRequest extends FormRequest
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
            'sms_code' => 'required|min:1|max:4',
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
            'sms_code.required' => __( 'Укажите код из SMS' ),
            'sms_code.min' => __( 'Минимальное кол.-во символов 1' ),
            'sms_code.max' => __( 'Максимальное кол.-во символов 4' ),
        ];

    }

}
