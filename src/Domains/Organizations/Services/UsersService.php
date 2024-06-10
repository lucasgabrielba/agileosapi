<?php

namespace Domains\Organizations\Services;

use Domains\Organizations\Actions\Users\CreateUser;
use Domains\Organizations\Actions\Users\DeleteUser;
use Domains\Organizations\Actions\Users\GetUser;
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
        return GetUser::execute($userId);
    }

    public function update(string $userId, array $data): User
    {
        $user = User::findOrFail($userId);

        return UpdateUser::execute($user, $data);
    }

    public function destroy(string $userId): void
    {
        $user = User::findOrFail($userId);

        return DeleteUser::execute($user);
    }
}
