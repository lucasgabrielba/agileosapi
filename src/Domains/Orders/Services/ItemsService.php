<?php

namespace Domains\Orders\Services;

use Domains\Orders\Actions\Items\CreateItem;
use Domains\Orders\Actions\Items\DeleteItem;
use Domains\Orders\Actions\Items\ListItems;
use Domains\Orders\Actions\Items\UpdateItem;
use Domains\Orders\Contracts\ItemsServiceInterface;
use Domains\Orders\Models\Item;
use Domains\Organizations\Models\Organization;
use Illuminate\Pagination\LengthAwarePaginator;

class ItemsService implements ItemsServiceInterface
{
    public function list(string $organizationId, array $filters): LengthAwarePaginator
    {
        $organization = Organization::findOrFail($organizationId);

        return ListItems::execute($organization, $filters);
    }

    public function create(string $organizationId, string $clientId, array $data): Item
    {
        return CreateItem::execute($organizationId, $clientId, $data);
    }

    public function get(string $itemId): Item
    {
        return Item::findOrFail($itemId);
    }

    public function update(string $organizationId, string $itemId, array $data): void
    {
        UpdateItem::execute($organizationId, $itemId, $data);
    }

    public function destroy(string $organizationId, string $itemId): void
    {
        DeleteItem::execute($organizationId, $itemId);
    }
}
