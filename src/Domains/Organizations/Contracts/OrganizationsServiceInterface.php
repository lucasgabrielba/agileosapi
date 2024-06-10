<?php

namespace Domains\Organizations\Contracts;

use Domains\Organizations\Models\Organization;

interface OrganizationsServiceInterface
{
    public function list();

    public function create(array $data): Organization;

    public function getOne(string $organizationId): Organization;

    public function update(string $organizationId, array $data): Organization;

    public function destroy(string $organizationId): void;
}
