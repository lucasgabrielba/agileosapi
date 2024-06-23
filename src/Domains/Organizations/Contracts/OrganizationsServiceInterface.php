<?php

namespace Domains\Organizations\Contracts;

use Domains\Organizations\Models\Organization;
use Illuminate\Pagination\LengthAwarePaginator;

interface OrganizationsServiceInterface
{
    public function list(array $filters): LengthAwarePaginator;

    public function create(array $data): Organization;

    public function get(string $organizationId): Organization;

    public function update(string $organizationId, array $data): void;

    public function destroy(string $organizationId): void;
}
