<?php

namespace Domains\Orders\Actions\Items;

use Domains\Orders\Events\Items\ItemCreated;
use Domains\Orders\Models\Client;
use Domains\Orders\Models\Item;

class CreateItem
{
    public static function execute(array $data, Client $client): Item
    {
        $item = Item::create([
            'client_id' => $client->id,
            'organization_id' => $client->organization_id,

            ...$data,
        ]);

        event(new ItemCreated($client->organization_id, $item));

        return $item;
    }
}
