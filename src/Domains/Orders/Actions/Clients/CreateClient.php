<?php

namespace Domains\Orders\Actions\Clients;

use Domains\Orders\Events\Clients\ClientCreated;
use Domains\Orders\Models\Client;
use Domains\Organizations\Models\Organization;

class CreateClient
{
    public static function execute(array $data, Organization $organization): Client
    {
        $organization->clients()->create($data)->save();

        $client = $organization->clients->last();

        event(new ClientCreated($organization->id, $client));

        return $client;
    }
}
