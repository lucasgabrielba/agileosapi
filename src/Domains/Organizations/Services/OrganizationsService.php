<?php

namespace Domains\Organizations\Services;

use Domains\Organizations\Actions\Organizations\CreateOrganization;
use Domains\Organizations\Actions\Organizations\DeleteOrganization;
use Domains\Organizations\Actions\Organizations\GetOrganization;
use Domains\Organizations\Actions\Organizations\ListOrganizations;
use Domains\Organizations\Actions\Organizations\UpdateOrganization;
use Domains\Organizations\Contracts\OrganizationsServiceInterface;
use Domains\Organizations\Models\Organization;

class OrganizationsService implements OrganizationsServiceInterface
{
    public function list()
    {
        return ListOrganizations::execute();
    }

    public function create(array $data): Organization
    {
        return CreateOrganization::execute($data);
    }

    public function getOne(string $organizationId): Organization
    {
        return GetOrganization::execute($organizationId);
    }

    public function update(string $organizationId, array $data): Organization
    {
        $organization = Organization::findOrFail($organizationId);

        return UpdateOrganization::execute($organization, $data);
    }

    public function destroy(string $organizationId): void
    {
        $organization = Organization::findOrFail($organizationId);

        return DeleteOrganization::execute($organization);
    }
}
