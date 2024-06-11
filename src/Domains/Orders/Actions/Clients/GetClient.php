<?php

namespace Domains\Orders\Actions\Clients;

use Domains\Orders\Models\Client;

class GetClient
{
    public static function execute(string $clientId): Client
    {
        $client = Client::findOrFail($clientId);

        return $client;
    }
}
