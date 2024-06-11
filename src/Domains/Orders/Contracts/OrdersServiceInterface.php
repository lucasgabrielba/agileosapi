<?php

namespace Domains\Orders\Contracts;

use Domains\Orders\Models\Order;
use Illuminate\Pagination\LengthAwarePaginator;

interface OrdersServiceInterface
{
    public function list(array $filters): LengthAwarePaginator;

    public function create(array $data): Order;

    public function get(string $orderId): Order;

    public function update(string $orderId, array $data): Order;

    public function destroy(string $orderId): void;
}
