<?php

namespace Domains\Organizations\Actions\Users;

use Domains\Organizations\Events\Users\UserCreated;
use Domains\Organizations\Models\Organization;
use Domains\Organizations\Models\User;

class CreateUser
{
    public static function execute(array $data, Organization $organization): User
    {
        $organization->users()->create($data)->save();

        $user = $organization->users->last();

        event(new UserCreated($organization->id, $user));

        return $user;
    }
}
