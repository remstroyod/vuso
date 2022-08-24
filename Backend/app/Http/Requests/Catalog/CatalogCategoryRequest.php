<?php

namespace Backend\Http\Requests\Catalog;

use Illuminate\Foundation\Http\FormRequest;

class CatalogCategoryRequest extends FormRequest
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
            'name' => 'required|max:255',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'name.required' => __( 'Наименование не может быть пустым' ),
        ];
    }

}
