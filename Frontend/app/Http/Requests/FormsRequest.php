<?php

namespace Frontend\Http\Requests;

use Backend\Enums\FormsEnum;
use Illuminate\Foundation\Http\FormRequest;

class FormsRequest extends FormRequest
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

        if( $this->type == FormsEnum::reviews )
        {
            return [
                'name' => 'required',
                'email' => 'required|email',
                'message' => 'required|min:10',
                //'g-recaptcha-response' => 'required|captcha'
            ];
        }

        if( $this->type == FormsEnum::question )
        {
            return [
                'message' => 'required',
                'g-recaptcha-response' => 'required|captcha'
            ];
        }

        if( $this->type == FormsEnum::consultation )
        {

            if( $this->request->has('phone') )
            {
                return [
                    'phone' => 'required',
                    //'g-recaptcha-response' => 'required|captcha'
                ];
            }else{
                return [
                    'name' => 'required',
                    //'g-recaptcha-response' => 'required|captcha'
                ];
            }

        }

        if( $this->type == FormsEnum::payment )
        {
            return [
                'name' => 'required',
                'phone' => 'required',
                //'g-recaptcha-response' => 'required|captcha'
            ];
        }

        if( $this->type == FormsEnum::partners )
        {
            return [
                'name' => 'required',
                'email' => 'required|email',
                //'g-recaptcha-response' => 'required|captcha'
            ];
        }

        if( $this->type == FormsEnum::support )
        {
            return [
                'name' => 'required',
                'phone' => 'required',
                'message' => 'required|min:10',
                //'g-recaptcha-response' => 'required|captcha'
            ];
        }

        if( $this->type == FormsEnum::subscribe )
        {
            return [
                'email' => 'required|email',
                //'g-recaptcha-response' => 'required|captcha'
            ];
        }

        if( $this->type == FormsEnum::request )
        {
            return [
                'phone' => 'required',
                'message' => 'required|min:10',
                //'g-recaptcha-response' => 'required|captcha'
            ];
        }

        return [

        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {

        return [
            'name.required' => 'Заполните поле Имя',
            'message.required' => 'Заполните поле Сообщение',
            'message.min' => 'Минимальное кол.-во символов 10',
            'email.required' => 'Заполните поле E-mail',
            'email.email' => 'Неверный формат',
            'phone.required' => 'Заполните поле Телефон',
        ];

    }

}
