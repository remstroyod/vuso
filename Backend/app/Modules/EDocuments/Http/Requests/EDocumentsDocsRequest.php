<?php

namespace Backend\Modules\EDocuments\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EDocumentsDocsRequest extends FormRequest
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
            'documents_id'  => 'sometimes|exists:edocuments,id',
            'is_active'     => 'integer',
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
            'documents_id.sometimes' => __( 'Не указан тип документа' ),
        ];
    }

}
