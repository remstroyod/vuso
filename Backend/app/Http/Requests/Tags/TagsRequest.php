<?php

namespace Backend\Http\Requests\Tags;

use Illuminate\Foundation\Http\FormRequest;

class TagsRequest extends FormRequest
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
            'name'          => 'required|max:255',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'name.required' => __( 'Не заполнено поле Наименоваие' ),
        ];
    }

}
