<?php

namespace Domains\Orders\Actions\Clients;

use Domains\Orders\Events\Clients\ClientCreated;
use Domains\Orders\Models\Client;
use Domains\Organizations\Models\Organization;

class CreateClient
{
    public static function execute(array $data, Organization $organization): Client
    {
        $client = self::findExistingClient($data, $organization);

        if ($client) {
            self::updateClientAddress($client, $data);

            return $client;
        }

        $client = $organization->clients()->create($data);
        self::createClientAddress($client, $data);

        event(new ClientCreated($organization->id, $client));

        return $client;
    }

    private static function findExistingClient(array $data, Organization $organization): ?Client
    {
        foreach ($data['phones'] as $phone) {
            $client = $organization->clients()
                ->where('email', $data['email'])
                ->orWhere('document', $data['document'])
                ->orWhereJsonContains('phones', $phone)
                ->first();

            if ($client) {
                throw new \Exception('Client already exists.');
            }
        }

        return null;
    }

    private static function updateClientAddress(Client $client, array $data): void
    {
        if (isset($data['address'])) {
            $client->address()->update($data['address']);
        }
    }

    private static function createClientAddress(Client $client, array $data): void
    {
        if (isset($data['address'])) {
            $client->address()->create($data['address']);
        } else {
            $client->address()->create();
        }
    }
}
