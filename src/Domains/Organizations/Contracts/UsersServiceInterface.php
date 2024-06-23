<?php

namespace Domains\Organizations\Contracts;

use Domains\Organizations\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface UsersServiceInterface
{
    public function list(string $organizationId, array $filters): LengthAwarePaginator;

    public function create(string $organizationId, array $data): User;

    public function get(string $userId): User;

    public function update(string $organizationId, string $userId, array $data): void;

    public function destroy(string $organizationId, string $userId): void;
}
