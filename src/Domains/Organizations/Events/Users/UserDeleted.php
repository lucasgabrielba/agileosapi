<?php

namespace Domains\Organizations\Events\Users;

use Domains\Shared\Enums\PermissionsEnum;
use Domains\Shared\Events\DispatchEventsByPermission;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserDeleted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;

    public $organizationId;

    public function __construct(string $organizationId, string $userId)
    {
        $this->organizationId = $organizationId;
        $this->userId = $userId;
    }

    public function broadcastAs()
    {
        return 'user-deleted';
    }

    public function broadcastOn()
    {
        return DispatchEventsByPermission::execute(
            $this->organizationId,
            PermissionsEnum::DELETE_USERS
        );
    }
}
