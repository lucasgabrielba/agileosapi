<?php

namespace Domains\Orders\Actions\Orders;

use Domains\Orders\Events\Orders\OrderDeleted;
use Domains\Orders\Models\Order;

class DeleteOrder
{
    public static function execute(Order $order): void
    {
        $orderId = $order->id;
        $organizationId = $order->organization->id;

        $order->delete();

        event(new OrderDeleted($organizationId, $orderId));
    }
}
