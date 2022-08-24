<?php

namespace Backend\Modules\EDocuments\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EDocumentsPlaceholdersRequest extends FormRequest
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
            'name'          => 'required|max:255',
            'slug'          => 'required|max:50',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'name.required' => __( 'Не заполнено наименование' ),
            'name.max' => __( 'Максимальное число символов 255' ),
            'slug.required' => __( 'Не заполнен идентификатор' ),
            'slug.max' => __( 'Максимальное число символов 50' ),
        ];
    }

}
