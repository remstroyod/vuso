<?php

namespace Backend\Modules\PayHub\Http\Requests\Payment;

use Backend\Modules\PayHub\Models\AcquiringResponse;
use Illuminate\Foundation\Http\FormRequest;

class PaymentState extends FormRequest
{
    public function rules()
    {
        return [ (new AcquiringResponse())->getHashColumn() => [
            'required', 'min:32', 'max:32', 'string'] ];
    }
}