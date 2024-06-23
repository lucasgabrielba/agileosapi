<?php

namespace Domains\Organizations\Events\Organizations;

use Domains\Shared\Enums\PermissionsEnum;
use Domains\Shared\Events\DispatchEventsByPermission;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrganizationUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $organizationId;

    public function __construct(string $organizationId)
    {
        $this->organizationId = $organizationId;
    }

    public function broadcastAs()
    {
        return 'organization-updated';
    }

    public function broadcastOn()
    {
        return DispatchEventsByPermission::execute(
            $this->organizationId,
            PermissionsEnum::EDIT_ORGANIZATIONS
        );
    }
}
