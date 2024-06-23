<?php

namespace Domains\Orders\Actions\Clients;

use Domains\Orders\Events\Clients\ClientCreated;
use Domains\Orders\Models\Client;

class CreateClient
{
    public static function execute(array $data, string $organizationId): Client
    {
        self::findExistingClient($data, $organizationId);

        $client = Client::create([
            ...$data,
            'organization_id' => $organizationId,
        ]);

        self::createClientAddress($client, $data);
        self::createClientPhones($client, $data);

        event(new ClientCreated($organizationId, $client->id));

        return $client;
    }

    private static function findExistingClient(array $data, string $organizationId): ?Client
    {
        $client = Client::where('organization_id', $organizationId)
            ->where(function ($query) use ($data) {
                $query->where('email', $data['email'])
                    ->orWhere('document', $data['document']);
            })
            ->first();

        if ($client) {
            throw new \Exception('Client already exists.');
        }

        $clientWithPhone = Client::where('organization_id', $organizationId)
            ->whereHas('phones', function ($query) use ($data) {
                foreach ($data['phones'] as $phone) {
                    $query->orWhere('phone_number', $phone);
                }
            })
            ->first();

        if ($clientWithPhone) {
            throw new \Exception('Client already exists.');
        }

        return null;
    }

    private static function createClientAddress(Client $client, array $data): void
    {
        if (isset($data['address'])) {
            $client->address()->create($data['address']);
        } else {
            $client->address()->create();
        }
    }

    private static function createClientPhones(Client $client, array $data): void
    {
        if (isset($data['phones'])) {
            foreach ($data['phones'] as $phone) {
                $client->phones()->create(['phone_number' => $phone]);
            }
        }
    }
}
