<?php

namespace Domains\Orders\Actions\Orders;

use Domains\Orders\Events\Orders\OrderUpdated;
use Domains\Orders\Models\Order;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateOrder
{
    public static function execute(string $organizationId, string $orderId, array $data): void
    {
        try {
            Order::where('id', $orderId)->update($data);

            event(new OrderUpdated($organizationId, $orderId));
        } catch (ModelNotFoundException $e) {
            throw new Exception('Order not found');
        } catch (Exception $e) {
            throw new Exception('An error occurred during the update: '.$e->getMessage());
        }
    }
}
