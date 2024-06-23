<?php

namespace Domains\Orders\Contracts;

use Domains\Orders\Models\Order;
use Illuminate\Pagination\LengthAwarePaginator;

interface OrdersServiceInterface
{
    public function list(string $organizationId, array $filters): LengthAwarePaginator;

    public function create(string $organizationId, array $data);

    public function get(string $orderId): Order;

    public function update(string $organizationId, string $orderId, array $data): void;

    public function destroy(string $organizationId, string $orderId): void;
}
