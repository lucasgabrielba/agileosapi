<?php

namespace Domains\Organizations\Events\Organizations;

use Domains\Organizations\Models\Organization;
use Domains\Shared\Actions\Events\DispatchEventsByPermission;
use Domains\Shared\Enums\PermissionsEnum;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrganizationCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $organization;

    public function __construct(Organization $organization)
    {
        $this->organization = $organization;
    }

    public function broadcastOn()
    {
        return DispatchEventsByPermission::execute(
            $this->organization->id,
            PermissionsEnum::CREATE_ORGANIZATIONS
        );
    }
}
