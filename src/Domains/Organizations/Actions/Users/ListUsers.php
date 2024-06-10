<?php

namespace Domains\Organizations\Actions\Users;

use Domains\Organizations\Models\Organization;

class ListUsers
{
    public static function execute(string $organizationId): array
    {
        $organization = Organization::findOrFail($organizationId);
        $users = $organization->users;

        return $users;
    }
}
