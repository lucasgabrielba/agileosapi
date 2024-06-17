<?php

namespace Domains\Orders\Actions\Items;

use Domains\Orders\Events\Items\ItemCreated;
use Domains\Orders\Models\Client;
use Domains\Orders\Models\Item;
use Domains\Organizations\Models\Organization;

class CreateItem
{
    public static function execute(array $data, Organization $organization, ?Client $client): Item
    {
        $item = $organization->items()->create($data);

        if ($client) {
            $client->items()->attach($item->id);
        }

        event(new ItemCreated($organization->id, $item));

        return $item;
    }
}
