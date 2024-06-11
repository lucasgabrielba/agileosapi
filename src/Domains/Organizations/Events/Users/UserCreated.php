<?php

namespace Domains\Organizations\Events\Users;

use Domains\Organizations\Models\User;
use Domains\Shared\Actions\Events\DispatchEventsByPermission;
use Domains\Shared\Enums\PermissionsEnum;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;

    public $organizationId;

    public function __construct(string $organizationId, User $user)
    {
        $this->organizationId = $organizationId;
        $this->user = $user;
    }

    public function broadcastAs()
    {
        return 'user-created';
    }

    public function broadcastOn()
    {
        return DispatchEventsByPermission::execute(
            $this->organizationId,
            PermissionsEnum::CREATE_USERS
        );
    }
}
