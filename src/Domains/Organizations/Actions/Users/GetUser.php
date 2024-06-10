<?php

namespace Domains\Organizations\Actions\Users;

use Domains\Organizations\Models\User;

class GetUser
{
    public static function execute(string $userId): User
    {
        $user = User::findOrFail($userId);

        return $user;
    }
}
