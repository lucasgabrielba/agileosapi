<?php

namespace Domains\Orders\Actions\Items;

use Domains\Orders\Events\Items\ItemCreated;
use Domains\Orders\Models\Item;

class CreateItem
{
    public static function execute(string $organizationId, string $clientId, array $data): Item
    {
        $item = Item::create([
            ...$data,
            'organization_id' => $organizationId,
            'client_id' => $clientId,
        ]);

        event(new ItemCreated($organizationId, $item->id));

        return $item;
    }
}
