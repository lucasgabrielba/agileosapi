<?php

namespace Domains\Orders\Actions\Items;

use Domains\Orders\Events\Items\ItemCreated;
use Domains\Orders\Models\Client;
use Domains\Orders\Models\Item;

class CreateItem
{
    public static function execute(array $data, Client $client): Item
    {
        $client->items()->create($data)->save();

        $item = $client->items->last();

        event(new ItemCreated($client->id, $item));

        return $item;
    }
}
