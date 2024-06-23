<?php

namespace Domains\Orders\Contracts;

use Domains\Orders\Models\Item;
use Illuminate\Pagination\LengthAwarePaginator;

interface ItemsServiceInterface
{
    public function list(string $organizationId, array $filters): LengthAwarePaginator;

    public function create(string $organizationId, string $clientId, array $data): Item;

    public function get(string $itemId): Item;

    public function update(string $organizationId, string $itemId, array $data): void;

    public function destroy(string $organizationId, string $itemId): void;
}
