<?php

namespace Domains\Orders\Actions\Items;

use Domains\Orders\Models\Client;
use Domains\Orders\Models\Item;
use Domains\Shared\Helpers\ListDataHelper;
use Illuminate\Pagination\LengthAwarePaginator;

class ListItems
{
    public static function execute(Client $client, array $filters): LengthAwarePaginator
    {
        $helper = new ListDataHelper(new Item, $client);

        $items = $helper->list($filters);

        return $items;
    }
}
