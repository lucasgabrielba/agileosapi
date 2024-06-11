<?php

namespace Domains\Orders\Actions\Items;

use Domains\Orders\Events\Items\ItemDeleted;
use Domains\Orders\Models\Item;

class DeleteItem
{
    public static function execute(Item $item): void
    {
        $itemId = $item->id;
        $organizationId = $item->client()->organization()->id;

        $item->delete();

        event(new ItemDeleted($organizationId, $itemId));
    }
}
