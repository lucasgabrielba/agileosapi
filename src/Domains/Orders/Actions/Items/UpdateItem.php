<?php

namespace Domains\Orders\Actions\Items;

use Domains\Orders\Events\Items\ItemUpdated;
use Domains\Orders\Models\Item;

class UpdateItem
{
    public static function execute(Item $item, array $data): Item
    {
        $item->update($data);

        $organizationId = $item->client()->organization()->id;

        event(new ItemUpdated($organizationId, $item));

        return $item;
    }
}
