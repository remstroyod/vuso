<?php
namespace Backend\Listeners\Catalog;

use Backend\Events\Catalog\ContragentsEvent;
use Backend\Models\Catalog\Contragents;

class ContragentsListener
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
     * @param ContragentsEvent $event
     * @return void
     */
    public function handle(ContragentsEvent $event)
    {

        if( $event->contragents->is_attach ) {
            $contragent = new Contragents();
            $contragent
                ->whereNotIn('id', [$event->contragents->id])
                ->where('is_attach', 1)
                ->update([
                    'is_attach' => 0
                ]);
        }

    }
}
