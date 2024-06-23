<?php

namespace Domains\Organizations\Actions\Users;

use Domains\Organizations\Events\Users\UserDeleted;
use Domains\Organizations\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DeleteUser
{
    public static function execute(string $organizationId, string $userId): void
    {
        try {
            User::where('id', $userId)->delete();

            event(new UserDeleted($organizationId, $userId));
        } catch (ModelNotFoundException $e) {
            throw new Exception('User not found');
        } catch (Exception $e) {
            throw new Exception('An error occurred during the delete: '.$e->getMessage());
        }
    }
}
