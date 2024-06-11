<?php

namespace Domains\Organizations\Actions\Users;

use Domains\Organizations\Events\Users\UserUpdated;
use Domains\Organizations\Models\User;

class UpdateUser
{
    public static function execute(User $user, array $data): User
    {
        $user->update($data);

        $organizationId = $user->organizationId;

        event(new UserUpdated($organizationId, $user));

        return $user;
    }
}
