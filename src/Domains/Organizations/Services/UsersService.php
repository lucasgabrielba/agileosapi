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

class UsersService implements UsersServiceInterface
{
    public function list(string $organizationId)
    {
        return ListUsers::execute($organizationId);
    }

    public function create(array $data, string $organizationId): User
    {
        $organization = Organization::findOrFail($organizationId);

        return CreateUser::execute($data, $organization);
    }

    public function getOne(string $userId): User
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
