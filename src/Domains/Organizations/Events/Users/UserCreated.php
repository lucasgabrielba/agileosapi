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

    public $organization_id;

    public function __construct(string $organization_id, User $user)
    {
        $this->organization_id = $organization_id;
        $this->user = $user;
    }

    public function broadcastOn()
    {
        return DispatchEventsByPermission::execute(
            $this->organization_id,
            PermissionsEnum::CREATE_USERS
        );
    }
}
