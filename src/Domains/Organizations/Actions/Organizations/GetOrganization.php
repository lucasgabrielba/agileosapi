<?php

namespace Domains\Organizations\Actions\Organizations;

use Domains\Organizations\Models\Organization;

class GetOrganization
{
    public static function execute(string $organizationId): Organization
    {
        $organization = Organization::findOrFail($organizationId);

        return $organization;
    }
}
