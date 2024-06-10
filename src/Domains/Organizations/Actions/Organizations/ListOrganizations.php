<?php

namespace Domains\Organizations\Actions\Organizations;

use Domains\Organizations\Models\Organization;
use Domains\Shared\Helpers\ListDataHelper;
use Illuminate\Pagination\LengthAwarePaginator;

class ListOrganizations
{
    public static function execute(array $filters): LengthAwarePaginator
    {
        $helper = new ListDataHelper(new Organization);

        $organizations = $helper->list($filters);

        return $organizations;
    }
}
