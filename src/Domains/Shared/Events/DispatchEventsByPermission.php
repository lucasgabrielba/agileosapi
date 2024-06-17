<?php

namespace Domains\Shared\Events;

use Domains\Organizations\Models\Organization;
use Domains\Shared\Enums\PermissionsEnum;
use Illuminate\Broadcasting\PrivateChannel;

class DispatchEventsByPermission
{
    public static function execute(string $organizationId, PermissionsEnum $permission): array
    {
        $organization = Organization::findorFail($organizationId);

        $allowedUsers = $organization->users()->permission($permission->name)->get();

        $channels = [];
        foreach ($allowedUsers as $user) {
            $channels[] = new PrivateChannel('organizations.' . $organization->id . '.users.' . $user->id);
        }

        return $channels;
    }
}
