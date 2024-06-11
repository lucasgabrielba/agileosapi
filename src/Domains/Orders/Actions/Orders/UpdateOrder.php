<?php

namespace Domains\Orders\Actions\Orders;

use Domains\Orders\Events\Orders\OrderUpdated;
use Domains\Orders\Models\Order;

class UpdateOrder
{
    public static function execute(Order $order, array $data): Order
    {
        $order->update($data);

        $organizationId = $order->organizationId;

        event(new OrderUpdated($organizationId, $order));

        return $order;
    }
}
