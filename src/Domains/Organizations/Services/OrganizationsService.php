<?php

namespace App\Services;

use Domains\Organizations\Models\Organization;

class OrganizationsService implements OrganizationsServiceInterface
{
    public function list()
    {
        return Organization::all();
    }

    public function create(array $data): Organization
    {
        return Organization::create($data);
    }

    public function getOne(string $organizationId): Organization
    {
        return Organization::findOrFail($organizationId);
    }

    public function update(string $organizationId, array $data): Organization
    {
        $organization = Organization::findOrFail($organizationId);
        $organization->update($data);

        return $organization;
    }

    public function destroy(string $organizationId): void
    {
        $organization = Organization::findOrFail($organizationId);
        $organization->delete();
    }
}
