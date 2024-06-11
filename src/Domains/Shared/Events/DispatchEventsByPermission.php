<?php

namespace Domains\Shared\Actions\Events;

use App\Domains\Organizations\Data\Enums\PermissionsEnum;
use Domains\Organizations\Models\Organization;
use Illuminate\Broadcasting\PrivateChannel;

class DispatchEventsByPermission
{
    public static function execute(string $organization_id, PermissionsEnum $permission): array
    {
        $organization = Organization::findorFail($organization_id);

        $allowed_users = $organization->users()->permission($permission->name)->get();

        $channels = [];
        foreach ($allowed_users as $user) {
            $channels[] = new PrivateChannel('organizations.'.$organization->id.'.users.'.$user->id);
        }

        return $channels;
    }
}
