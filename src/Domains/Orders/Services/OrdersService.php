<?php

namespace Domains\Orders\Services;

use Domains\Orders\Actions\Orders\CreateOrder;
use Domains\Orders\Actions\Orders\DeleteOrder;
use Domains\Orders\Actions\Orders\GetOrder;
use Domains\Orders\Actions\Orders\ListOrders;
use Domains\Orders\Actions\Orders\UpdateOrder;
use Domains\Orders\Contracts\OrdersServiceInterface;
use Domains\Orders\Models\Order;
use Domains\Organizations\Models\Organization;
use Illuminate\Pagination\LengthAwarePaginator;

class OrdersService implements OrdersServiceInterface
{
    public function list(string $organizationId, array $filters): LengthAwarePaginator
    {
        $organization = Organization::findOrFail($organizationId);

        return ListOrders::execute($organization, $filters);
    }

    public function create(string $organizationId, array $data): Order
    {
        $organization = Organization::findOrFail($organizationId);

        return CreateOrder::execute($data, $organization);
    }

    public function get(string $orderId): Order
    {
        return GetOrder::execute($orderId);
    }

    public function update(string $orderId, array $data): Order
    {
        $order = Order::findOrFail($orderId);

        return UpdateOrder::execute($order, $data);
    }

    public function destroy(string $orderId): void
    {
        $order = Order::findOrFail($orderId);

        DeleteOrder::execute($order);
    }
}
