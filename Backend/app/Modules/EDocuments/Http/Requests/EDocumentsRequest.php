<?php

namespace Backend\Modules\EDocuments\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EDocumentsRequest extends FormRequest
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
            'endpoint'      => 'required|max:50',
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
            'endpoint.required' => __( 'Не заполнен endpoint' ),
            'endpoint.max' => __( 'Максимальное число символов 50' ),
        ];
    }

}
