<?php

namespace Domains\Orders\Actions\Items;

use Domains\Orders\Events\Items\ItemCreated;
use Domains\Orders\Models\Client;

class CreateItems
{
    public static function execute(array $data, Client $client): array
    {
        $items = [];
        foreach ($data as $item) {
            $items[] = $client->items()->create($item)->save();

            event(new ItemCreated($client->id, $item));
        }

        return $items;
    }
}
