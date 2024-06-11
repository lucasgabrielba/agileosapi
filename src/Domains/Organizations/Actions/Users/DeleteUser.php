<?php

namespace Domains\Organizations\Actions\Users;

use Domains\Organizations\Events\Users\UserDeleted;
use Domains\Organizations\Models\User;

class DeleteUser
{
    public static function execute(User $user): void
    {
        $user_id = $user->id;
        $organization_id = $user->organization->id;

        $user->delete();

        event(new UserDeleted($organization_id, $user_id));
    }
}
