<?php

namespace Domains\Organizations\Events\Users;

use App\Domains\Organizations\Data\Enums\PermissionsEnum;
use Domains\Shared\Actions\Events\DispatchEventsByPermission;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserDeleted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;

    public $organization_id;

    public function __construct(string $organization_id, string $user_id)
    {
        $this->organization_id = $organization_id;
        $this->user_id = $user_id;
    }

    public function broadcastOn()
    {
        return DispatchEventsByPermission::execute(
            $this->organization_id,
            PermissionsEnum::DELETE_USERS
        );
    }
}
