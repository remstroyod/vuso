<?php
namespace Frontend\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Cookie;

class LogoutSuccessful
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
     * @param  \Illuminate\Auth\Events\Logout  $event
     * @return void
     */
    public function handle(Logout $event)
    {

        Cookie::queue(Cookie::forget('user'));

    }
}
