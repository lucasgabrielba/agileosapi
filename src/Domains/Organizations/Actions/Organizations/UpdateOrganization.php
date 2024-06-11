<?php

namespace Domains\Organizations\Actions\Organizations;

use Domains\Organizations\Events\Organizations\OrganizationUpdated;
use Domains\Organizations\Models\Organization;

class UpdateOrganization
{
    public static function execute(Organization $organization, array $data): Organization
    {
        $organization->update($data);

        event(new OrganizationUpdated($organization));

        return $organization;
    }
}
