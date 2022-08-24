<?php

namespace Frontend\Services\User;

use Frontend\Models\Profile\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserPasswordService
{
    public function __construct(
        public User $user
    ) {}

    public function savePassword(string $password): void
    {
        $this->user->fill([
            'password' => Hash::make($password)
        ])->save();
    }

    public function savePhone(string $newPhone): void
    {
        $this->user->detail->fill([
            'phone' => Str::onlyNumber($newPhone)
        ])->save();
    }
}
