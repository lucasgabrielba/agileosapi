<?php

namespace Domains\Organizations\Actions\Users;

use Domains\Organizations\Events\Users\UserDeleted;
use Domains\Organizations\Models\User;

class DeleteUser
{
    public static function execute(User $user): void
    {
        $userId = $user->id;
        $organizationId = $user->organization->id;

        $user->delete();

        event(new UserDeleted($organizationId, $userId));
    }
}
