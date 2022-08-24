<?php

namespace Frontend\Rules;

use Frontend\Models\Profile\UserDetail;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;

class PhoneExist implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return UserDetail::query()->where('phone', '=', Str::onlyNumber($value))->doesntExist();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __( 'Такой номер телефона уже есть' );
    }
}
