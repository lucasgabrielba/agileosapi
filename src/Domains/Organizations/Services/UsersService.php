<?php

namespace Domains\Organizations\Services;

use Domains\Organizations\Actions\Users\CreateUser;
use Domains\Organizations\Actions\Users\DeleteUser;
use Domains\Organizations\Actions\Users\ListUsers;
use Domains\Organizations\Actions\Users\UpdateUser;
use Domains\Organizations\Contracts\UsersServiceInterface;
use Domains\Organizations\Models\Organization;
use Domains\Organizations\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class UsersService implements UsersServiceInterface
{
    public function list(string $organizationId, array $filters): LengthAwarePaginator
    {
        $organization = Organization::findOrFail($organizationId);

        return ListUsers::execute($organization, $filters);
    }

    public function create(string $organizationId, array $data): User
    {
        $organization = Organization::findOrFail($organizationId);

        return CreateUser::execute($data, $organization);
    }

    public function get(string $userId): User
    {
        return User::findOrFail($userId);
    }

    public function update(string $organizationId, string $userId, array $data): void
    {
        UpdateUser::execute($organizationId, $userId, $data);
    }

    public function destroy(string $organizationId, string $userId): void
    {
        DeleteUser::execute($organizationId, $userId);
    }
}
