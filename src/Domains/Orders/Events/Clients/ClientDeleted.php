<?php

namespace Domains\Orders\Events\Clients;

use Domains\Shared\Enums\PermissionsEnum;
use Domains\Shared\Events\DispatchEventsByPermission;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ClientDeleted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $client;

    public $organizationId;

    public function __construct(string $organizationId, string $clientId)
    {
        $this->organizationId = $organizationId;
        $this->clientId = $clientId;
    }

    public function broadcastAs()
    {
        return 'client-deleted';
    }

    public function broadcastOn()
    {
        return DispatchEventsByPermission::execute(
            $this->organizationId,
            PermissionsEnum::DELETE_CLIENTS
        );
    }
}
