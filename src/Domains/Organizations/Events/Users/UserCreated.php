<?php

namespace Domains\Organizations\Events\Users;

use App\Domains\Organizations\Data\Enums\PermissionsEnum;
use Domains\Organizations\Models\User;
use Domains\Shared\Actions\Events\DispatchEventsByPermission;
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

    public function broadcastOn()
    {
        return DispatchEventsByPermission::execute(
            $this->organizationId,
            PermissionsEnum::CREATE_USERS
        );
    }
}
