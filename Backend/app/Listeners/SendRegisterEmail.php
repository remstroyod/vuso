<?php

namespace Backend\Listeners;

use Backend\Events\NewUserRegistered;
use Illuminate\Support\Facades\Mail;

class SendRegisterEmail
{
    /**
     * Handle the event.
     *
     * @param  NewUserRegistered  $event
     */
    public function handle(NewUserRegistered $event)
    {

        $user = $event->user;

        /**
         * Send Mail
         */
        Mail::send('emails.registration', ['user' => $user], function ($message) use ($user) {
            $message->from('remstroy-od@yandex.ru', 'Alex Cherniy');
            $message->subject('Вы зарегистрированы на сайте VUSO.');
            $message->to($user->email);
            $message->to('remstroyod@gmail.com');
        });

    }
}
