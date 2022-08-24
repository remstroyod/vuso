<?php

namespace Frontend\Observers;

use Frontend\Models\Profile\User;
use Frontend\Notifications\UserAdminNotification;
use Frontend\Notifications\UserNotification;
use Illuminate\Support\Facades\Notification;

class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \Frontend\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {

        /**
         * Send Admin Mail
         */
        Notification::route('mail', [settings('site_email') => 'Vuso'])
            ->notify(new UserAdminNotification($user));

        /**
         * Send User mail
         */
        $user->notify(new UserNotification($user));

    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \Frontend\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \Frontend\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \Frontend\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \Frontend\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
