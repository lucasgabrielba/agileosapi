<?php

namespace Domains\Organizations\Actions\Users;

use Domains\Organizations\Events\Users\UserUpdated;
use Domains\Organizations\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateUser
{
    public static function execute(string $organizationId, string $userId, array $data): void
    {
        try {
            User::where('id', $userId)->update($data);

            event(new UserUpdated($organizationId, $userId));
        } catch (ModelNotFoundException $e) {
            throw new Exception('User not found');
        } catch (Exception $e) {
            throw new Exception('An error occurred during the update: '.$e->getMessage());
        }
    }
}
