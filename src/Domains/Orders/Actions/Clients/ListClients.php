<?php

namespace Domains\Orders\Actions\Clients;

use Domains\Orders\Models\Client;
use Domains\Organizations\Models\Organization;
use Domains\Shared\Helpers\ListDataHelper;
use Illuminate\Pagination\LengthAwarePaginator;

class ListClients
{
    public static function execute(Organization $organization, array $filters): LengthAwarePaginator
    {
        $helper = new ListDataHelper(new Client, $organization);

        $clients = $helper->list($filters);

        return $clients;
    }
}
