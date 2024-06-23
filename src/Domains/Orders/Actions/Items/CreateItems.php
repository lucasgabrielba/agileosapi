<?php

namespace Domains\Orders\Actions\Items;

use Domains\Orders\Events\Items\ItemCreated;
use Domains\Orders\Models\Item;

class CreateItems
{
    public static function execute(string $organizationId, string $clientId, array $itemsData): array
    {
        $items = [];
        foreach ($itemsData as $itemData) {
            $newItem = Item::create([
                ...$itemData,
                'client_id' => $clientId,
                'organization_id' => $organizationId,
            ]);

            event(new ItemCreated($organizationId, $newItem));

            $items[] = $newItem;
        }

        return $items;
    }
}
