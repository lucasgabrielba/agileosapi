<?php

namespace Domains\Organizations\Actions\Organizations;

use Domains\Organizations\Models\Organization;

class ListOrganizations
{
    public static function execute(): array
    {
        $organizations = Organization::all();

        return $organizations->toArray();
    }
}
