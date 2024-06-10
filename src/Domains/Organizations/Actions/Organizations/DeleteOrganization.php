<?php

namespace Domains\Organizations\Actions\Organizations;

use Domains\Organizations\Models\Organization;

class DeleteOrganization
{
    public static function execute(Organization $organization): void
    {
        $organization->delete();
    }
}
