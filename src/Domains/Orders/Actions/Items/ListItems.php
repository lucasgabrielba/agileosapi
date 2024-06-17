<?php

namespace Domains\Orders\Actions\Items;

use Domains\Orders\Models\Item;
use Domains\Organizations\Models\Organization;
use Domains\Shared\Helpers\ListDataHelper;
use Illuminate\Pagination\LengthAwarePaginator;

class ListItems
{
    public static function execute(Organization $organization, array $filters): LengthAwarePaginator
    {
        $helper = new ListDataHelper(new Item, $organization);

        $items = $helper->list($filters);

        return $items;
    }
}
