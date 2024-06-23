<?php

namespace Domains\Orders\Actions\Orders;

use Domains\Orders\Models\Order;
use Domains\Organizations\Models\Organization;
use Domains\Shared\Helpers\ListDataHelper;
use Illuminate\Pagination\LengthAwarePaginator;

class ListOrders
{
    public static function execute(Organization $organization, array $filters): LengthAwarePaginator
    {
        $helper = new ListDataHelper(new Order);

        $orders = $helper->list($filters);

        return $orders;
    }
}
