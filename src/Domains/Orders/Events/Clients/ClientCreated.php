<?php

namespace Domains\Orders\Events\Clients;

use Domains\Orders\Models\Client;
use Domains\Shared\Actions\Events\DispatchEventsByPermission;
use Domains\Shared\Enums\PermissionsEnum;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ClientCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $client;

    public $organizationId;

    public function __construct(string $organizationId, Client $client)
    {
        $this->organizationId = $organizationId;
        $this->client = $client;
    }

    public function broadcastOn()
    {
        return DispatchEventsByPermission::execute(
            $this->organizationId,
            PermissionsEnum::CREATE_CLIENTS
        );
    }
}
