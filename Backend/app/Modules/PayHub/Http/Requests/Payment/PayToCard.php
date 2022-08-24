<?php

namespace Backend\Modules\PayHub\Http\Requests\Payment;

use Egorovwebservices\Payhub\Models\Response;
use Illuminate\Foundation\Http\FormRequest;

class PayToCard extends FormRequest
{
    public function rules()
    {
        return [
            'contract' => ['required', 'array']
        ];
    }
}