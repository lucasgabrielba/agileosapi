<?php

namespace Domains\Organizations\Events\Organizations;

use App\Domains\Organizations\Data\Enums\PermissionsEnum;
use Domains\Organizations\Models\Organization;
use Domains\Shared\Actions\Events\DispatchEventsByPermission;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrganizationUpdated implements ShouldBroadcast
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
            PermissionsEnum::EDIT_ORGANIZATIONS
        );
    }
}
