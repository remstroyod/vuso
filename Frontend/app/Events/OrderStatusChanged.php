<?php

namespace Frontend\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Backend\Modules\EDocuments\Models\EdocumentUser;

use Egorovwebservices\Payhub\Traits\Log as PayHubLog;

class OrderStatusChanged implements ShouldBroadcast
{
    use PayHubLog;
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $message;

    public EdocumentUser $contract;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(EdocumentUser $contract, $message)
    {
        $this->contract = $contract;
        $this->message = $message;

        info("dispatching.............   " . $this->contract->id);
    }

    protected function getPayHubLoggingSystem(): string
    {
        return $this->contract->getPaymentData()->getPaySystemKey();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('order-status-' . $this->contract->id);
    }

    public function broadcastAs()
    {
        return 'order.status';
    }

    public function broadcastWith()
    {
        return [
            'contract' => $this->contract,
            'message' => $this->message
        ];
    }
}
