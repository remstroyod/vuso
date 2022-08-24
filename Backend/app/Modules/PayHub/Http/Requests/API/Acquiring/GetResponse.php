<?php

namespace Backend\Modules\PayHub\Http\Requests\API\Acquiring;

use Backend\Modules\PayHub\Models\AcquiringResponse;
use Illuminate\Foundation\Http\FormRequest;

class GetResponse extends FormRequest
{
    public function rules()
    {
        return [
            (new AcquiringResponse())->getHashColumn() => [
                'required', 'min:32', 'max:32', 'string'
            ]
        ];
    }
}