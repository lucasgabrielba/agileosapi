<?php

namespace Domains\Organizations\Actions\Users;

use Domains\Organizations\Events\Users\UserCreated;
use Domains\Organizations\Models\User;

class CreateUser
{
    public static function execute(array $data, string $organizationId): User
    {
        $user = User::create([
            ...$data,
            'organization_id' => $organizationId,
        ]);

        event(new UserCreated($organizationId, $user->id));

        return $user;
    }
}
