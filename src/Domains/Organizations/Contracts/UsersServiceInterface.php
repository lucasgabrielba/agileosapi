<?php

namespace Domains\Organizations\Contracts;

use Domains\Organizations\Models\User;

interface UsersServiceInterface
{
    public function list(string $organizationId);

    public function create(array $data, string $organizationId): User;

    public function getOne(string $userId): User;

    public function update(string $userId, array $data): User;

    public function destroy(string $userId): void;
}
