<?php

namespace Domains\Organizations\Actions\Organizations;

use Domains\Organizations\Events\Organizations\OrganizationCreated;
use Domains\Organizations\Models\Organization;

class CreateOrganization
{
    public static function execute(array $data): Organization
    {
        $organization = Organization::create($data);

        event(new OrganizationCreated($organization));

        return $organization;
    }
}
