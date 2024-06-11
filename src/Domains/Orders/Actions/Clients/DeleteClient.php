<?php

namespace Domains\Clients\Actions\Clients;

use Domains\Orders\Events\Clients\ClientDeleted;
use Domains\Orders\Models\Client;

class DeleteClient
{
    public static function execute(Client $client): void
    {
        $clientId = $client->id;
        $organizationId = $client->organization->id;

        $client->delete();

        event(new ClientDeleted($organizationId, $clientId));
    }
}
