<?php

namespace Domains\Organizations\Actions\Users;

use Domains\Organizations\Models\Organization;
use Domains\Organizations\Models\User;
use Domains\Shared\Helpers\ListDataHelper;
use Illuminate\Pagination\LengthAwarePaginator;

class ListUsers
{
    public static function execute(Organization $organization, array $filters): LengthAwarePaginator
    {
        $helper = new ListDataHelper(new User, $organization);

        $users = $helper->list($filters);

        return $users;
    }
}
