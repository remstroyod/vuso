<?php

namespace Frontend\Providers;

use Frontend\Events\FormsDataEvent;
use Frontend\Listeners\FormsDataBitrix;
use Frontend\Listeners\FormsDataListener;
use Frontend\Listeners\LoginSuccessful;
use Frontend\Listeners\LogoutSuccessful;
use Frontend\Models\Profile\User;
use Frontend\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'Illuminate\Auth\Events\Login' => [
            LoginSuccessful::class,
        ],
        'Illuminate\Auth\Events\Logout' => [
            LogoutSuccessful::class,
        ],
        FormsDataEvent::class => [
            //FormsDataListener::class,
            FormsDataBitrix::class,
        ],
        \SocialiteProviders\Manager\SocialiteWasCalled::class => [
            \SocialiteProviders\Telegram\TelegramExtendSocialite::class.'@handle',
            \SocialiteProviders\Google\GoogleExtendSocialite::class.'@handle',
            \SocialiteProviders\Apple\AppleExtendSocialite::class.'@handle',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {

        parent::boot();

        /**
         * User
         */
        User::observe(UserObserver::class);

    }
}
