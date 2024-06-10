<?php

namespace Domains\Organizations\Actions\Users;

use Domains\Organizations\Models\User;

class UpdateUser
{
    public static function execute(User $user, array $data): User
    {
        $user->update($data);

        return $user;
    }
}
