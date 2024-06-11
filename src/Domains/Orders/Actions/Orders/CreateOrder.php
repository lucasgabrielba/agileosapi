<?php

namespace Domains\Orders\Actions\Orders;

use Domains\Orders\Events\Orders\OrderCreated;
use Domains\Orders\Models\Order;
use Domains\Organizations\Models\Organization;

class CreateOrder
{
    public static function execute(array $data, Organization $organization): Order
    {
        $organization->orders()->create($data)->save();

        $order = $organization->orders->last();

        event(new OrderCreated($organization->id, $order));

        return $order;
    }
}
