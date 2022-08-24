<?php

namespace Backend\Modules\PayHub\Http\Requests\Payment;

use Illuminate\Foundation\Http\FormRequest;

class PayRecurrent extends FormRequest
{
    public function rules()
    {
        return [
            'payment' => ['required', 'array'],
        ];
    }
}