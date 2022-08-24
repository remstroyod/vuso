<?php

namespace Backend\Http\Requests\Contacts;

use Illuminate\Foundation\Http\FormRequest;

class ContactsRequest extends FormRequest
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
            'is_active'     => 'integer',
        ];
    }

}
