<?php

namespace Backend\Providers;

use Backend\Events\Catalog\ContragentsEvent;
use Backend\Events\NewUserRegistered;
use Backend\Listeners\Catalog\ContragentsListener;
use Backend\Listeners\SendRegisterEmail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

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
        NewUserRegistered::class => [
            SendRegisterEmail::class,
        ],
        ContragentsEvent::class => [
            ContragentsListener::class,
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

        Event::listen('revisionable.*', function($model, $revisions) {

        });

    }
}
