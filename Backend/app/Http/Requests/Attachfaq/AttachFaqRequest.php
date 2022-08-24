<?php

namespace Backend\Http\Requests\Attachfaq;

use Illuminate\Foundation\Http\FormRequest;

class AttachFaqRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [

        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [

        ];
    }

}
