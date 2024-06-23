<?php

namespace Domains\Orders\Events\Orders;

use Domains\Shared\Enums\PermissionsEnum;
use Domains\Shared\Events\DispatchEventsByPermission;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $orderId;

    public $organizationId;

    public function __construct(string $organizationId, string $orderId)
    {
        $this->organizationId = $organizationId;
        $this->orderId = $orderId;
    }

    public function broadcastAs()
    {
        return 'order-created';
    }

    public function broadcastOn()
    {
        return DispatchEventsByPermission::execute(
            $this->organizationId,
            PermissionsEnum::CREATE_ORDERS
        );
    }
}
