<?php
namespace Backend\Events\Catalog;

use Backend\Models\Catalog\Contragents;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ContragentsEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var
     */
    public $contragents;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Contragents $contragents)
    {

        $this->contragents = $contragents;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return [];
    }
}
