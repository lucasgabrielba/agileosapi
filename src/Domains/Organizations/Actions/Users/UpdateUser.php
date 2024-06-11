<?php

namespace Domains\Organizations\Actions\Users;

use Domains\Organizations\Events\Users\UserUpdated;
use Domains\Organizations\Models\User;

class UpdateUser
{
    public static function execute(User $user, array $data): User
    {
        $user->update($data);

        $organization_id = $user->organization_id;

        event(new UserUpdated($organization_id, $user));

        return $user;
    }
}
