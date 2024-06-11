<?php

namespace Domains\Orders\Services;

use Domains\Orders\Actions\Items\CreateItem;
use Domains\Orders\Actions\Items\DeleteItem;
use Domains\Orders\Actions\Items\GetItem;
use Domains\Orders\Actions\Items\ListItems;
use Domains\Orders\Actions\Items\UpdateItem;
use Domains\Orders\Contracts\ItemsServiceInterface;
use Domains\Orders\Models\Client;
use Domains\Orders\Models\Item;
use Illuminate\Pagination\LengthAwarePaginator;

class ItemsService implements ItemsServiceInterface
{
    public function list(string $clientId, array $filters): LengthAwarePaginator
    {
        $client = Client::findOrFail($clientId);

        return ListItems::execute($client, $filters);
    }

    public function create(string $clientId, array $data): Item
    {
        $client = Client::findOrFail($clientId);

        return CreateItem::execute($data, $client);
    }

    public function get(string $itemId): Item
    {
        return GetItem::execute($itemId);
    }

    public function update(string $itemId, array $data): Item
    {
        $item = Item::findOrFail($itemId);

        return UpdateItem::execute($item, $data);
    }

    public function destroy(string $itemId): void
    {
        $item = Item::findOrFail($itemId);

        DeleteItem::execute($item);
    }
}
