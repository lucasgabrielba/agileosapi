<?php

namespace Domains\Organizations\Actions\Organizations;

use Domains\Organizations\Events\Organizations\OrganizationDeleted;
use Domains\Organizations\Models\Organization;

class DeleteOrganization
{
    public static function execute(Organization $organization): void
    {
        $organizationId = $organization->id;

        $organization->delete();

        event(new OrganizationDeleted($organizationId));
    }
}
