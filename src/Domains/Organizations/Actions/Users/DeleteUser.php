<?php

namespace Domains\Organizations\Actions\Users;

use Domains\Organizations\Models\User;

class DeleteUser
{
    public static function execute(User $user): void
    {
        $user->delete();
    }
}
