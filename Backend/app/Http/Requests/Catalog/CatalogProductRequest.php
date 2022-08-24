<?php

namespace Backend\Http\Requests\Catalog;

use Illuminate\Foundation\Http\FormRequest;

class CatalogProductRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name'          => 'required|max:255',
            'category'      => 'required',
            'is_active'     => 'integer',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'name.required' => __( 'Наименование не может быть пустым' ),
            'category.required' => __( 'Необходимо указать категорию' ),
        ];
    }

}
