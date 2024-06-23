<?php

namespace Domains\Organizations\Services;

use Domains\Organizations\Actions\Organizations\CreateOrganization;
use Domains\Organizations\Actions\Organizations\DeleteOrganization;
use Domains\Organizations\Actions\Organizations\ListOrganizations;
use Domains\Organizations\Actions\Organizations\UpdateOrganization;
use Domains\Organizations\Contracts\OrganizationsServiceInterface;
use Domains\Organizations\Models\Organization;
use Illuminate\Pagination\LengthAwarePaginator;

class OrganizationsService implements OrganizationsServiceInterface
{
    public function list(array $filters): LengthAwarePaginator
    {
        return ListOrganizations::execute($filters);
    }

    public function create(array $data): Organization
    {
        return CreateOrganization::execute($data);
    }

    public function get(string $organizationId): Organization
    {
        return Organization::findOrFail($organizationId);
    }

    public function update(string $organizationId, array $data): void
    {
        UpdateOrganization::execute($organizationId, $data);
    }

    public function destroy(string $organizationId): void
    {
        DeleteOrganization::execute($organizationId);
    }
}
