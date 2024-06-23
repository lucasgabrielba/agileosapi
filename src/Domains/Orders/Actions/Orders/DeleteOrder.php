<?php

namespace Domains\Orders\Actions\Orders;

use Domains\Orders\Events\Orders\OrderDeleted;
use Domains\Orders\Models\Order;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DeleteOrder
{
    public static function execute(string $organizationId, string $orderId): void
    {
        try {
            Order::where('id', $orderId)->delete();

            event(new OrderDeleted($organizationId, $orderId));
        } catch (ModelNotFoundException $e) {
            throw new Exception('Order not found');
        } catch (Exception $e) {
            throw new Exception('An error occurred during the delete: '.$e->getMessage());
        }
    }
}
