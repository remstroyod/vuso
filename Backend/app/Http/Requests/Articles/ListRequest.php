<?php

namespace Backend\Http\Requests\Articles;

use Illuminate\Foundation\Http\FormRequest;

class ListRequest extends FormRequest
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
            'category_id'   => 'sometimes|exists:articles_categories,id',
            'is_active'     => 'integer',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'category_id.exists' => __( 'Не указана категория' ),
        ];
    }

}
