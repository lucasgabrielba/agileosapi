<?php

namespace Domains\Orders\Events\Orders;

use Domains\Orders\Models\Order;
use Domains\Shared\Actions\Events\DispatchEventsByPermission;
use Domains\Shared\Enums\PermissionsEnum;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $order;

    public $organizationId;

    public function __construct(string $organizationId, Order $order)
    {
        $this->organizationId = $organizationId;
        $this->order = $order;
    }

    public function broadcastOn()
    {
        return DispatchEventsByPermission::execute(
            $this->organizationId,
            PermissionsEnum::CREATE_ORDERS
        );
    }
}
