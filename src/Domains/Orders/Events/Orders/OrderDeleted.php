<?php

namespace Domains\Orders\Events\Orders;

use Domains\Shared\Actions\Events\DispatchEventsByPermission;
use Domains\Shared\Enums\PermissionsEnum;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderDeleted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $order;

    public $organizationId;

    public function __construct(string $organizationId, string $orderId)
    {
        $this->organizationId = $organizationId;
        $this->orderId = $orderId;
    }

    public function broadcastOn()
    {
        return DispatchEventsByPermission::execute(
            $this->organizationId,
            PermissionsEnum::DELETE_ORDERS
        );
    }
}
