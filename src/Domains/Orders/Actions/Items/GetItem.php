<?php

namespace Domains\Orders\Actions\Items;

use Domains\Orders\Models\Item;

class GetItem
{
    public static function execute(string $itemId): Item
    {
        $item = Item::findOrFail($itemId);

        return $item;
    }
}
