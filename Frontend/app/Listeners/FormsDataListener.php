<?php
namespace Frontend\Listeners;

use Frontend\Events\FormsDataEvent;
use Frontend\Notifications\FormsAdminNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class FormsDataListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \Frontend\Events\FormsDataEvent  $event
     * @return void
     */
    public function handle(FormsDataEvent $event)
    {

        $event->formsData->ip       = request()->ip();
        $event->formsData->browser  = request()->server('HTTP_USER_AGENT');
        $event->formsData->url      = request()->server('HTTP_REFERER');
        $event->formsData->is_auth  = (Auth::check()) ? 1 : 0;

        $event->formsData->save();

        Notification::route('mail', settings('site_email'))
            ->notify(new FormsAdminNotification($event->formsData));

    }
}
