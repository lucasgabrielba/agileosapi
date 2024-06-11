<?php

namespace Domains\Orders\Actions\Orders;

use Domains\Orders\Models\Order;

class GetOrder
{
    public static function execute(string $orderId): Order
    {
        $order = Order::findOrFail($orderId);

        return $order;
    }
}
