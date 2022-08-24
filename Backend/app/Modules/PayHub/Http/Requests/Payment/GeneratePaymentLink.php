<?php

namespace Backend\Modules\PayHub\Http\Requests\Payment;

use Backend\Modules\PayHub\Models\AcquiringResponse;
use Egorovwebservices\Payhub\Enums\PaySystemsEnum;
use Frontend\Http\Requests\FormsRequest;
use Illuminate\Validation\Rule;

class GeneratePaymentLink extends FormsRequest
{
    public function rules()
    {
        return  [
            (new AcquiringResponse())->getHashColumn() => ['required', 'min:32', 'max:32', 'string'],
            'payment_data' => ['required', 'array'],
            'payment_data.payment_system' => ['required', Rule::in(PaySystemsEnum::$systems), 'string'],
            'client_data' => ['required', 'array'],
        ];
    }
}