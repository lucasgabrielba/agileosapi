<?php

namespace Domains\Organizations\Actions\Users;

use Domains\Organizations\Models\Organization;
use Domains\Organizations\Models\User;

class CreateUser
{
    public static function execute(array $data, Organization $organization): User
    {
        $organization->users()->create($data)->save();

        return $organization->users->last();
    }
}
