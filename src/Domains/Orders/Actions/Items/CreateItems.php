<?php

namespace Domains\Orders\Actions\Items;

use Domains\Orders\Events\Items\ItemCreated;
use Domains\Orders\Models\Client;
use Domains\Orders\Models\Item;

class CreateItems
{
    public static function execute(array $itemsData, Client $client): array
    {
        $items = [];
        foreach ($itemsData as $itemData) {
            $newItem = Item::create([
                ...$itemData,
                'client_id' => $client->id,
                'organization_id' => $client->organization_id,
            ]);

            event(new ItemCreated($client->id, $newItem));

            $items[] = $newItem;
        }

        return $items;
    }
}
