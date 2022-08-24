<?php

namespace Frontend\Rules;

use Frontend\Models\Profile\User;
use Illuminate\Contracts\Validation\Rule;

class UserConfirmCode implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(
        public User $user
    ) {}

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->user->sms_code === (string)$value;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __( 'Неверный код' );
    }
}
