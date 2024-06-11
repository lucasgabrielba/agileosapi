<?php

namespace Domains\Orders\Actions\Clients;

use Domains\Orders\Events\Clients\ClientUpdated;
use Domains\Orders\Models\Client;

class UpdateClient
{
    public static function execute(Client $client, array $data): Client
    {
        $client->update($data);

        $organizationId = $client->organizationId;

        event(new ClientUpdated($organizationId, $client));

        return $client;
    }
}
