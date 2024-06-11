<?php

namespace Domains\Orders\Services;

use Domains\Orders\Actions\Clients\CreateClient;
use Domains\Orders\Actions\Clients\DeleteClient;
use Domains\Orders\Actions\Clients\GetClient;
use Domains\Orders\Actions\Clients\ListClients;
use Domains\Orders\Actions\Clients\UpdateClient;
use Domains\Orders\Contracts\ClientsServiceInterface;
use Domains\Orders\Models\Client;
use Domains\Organizations\Models\Organization;
use Illuminate\Pagination\LengthAwarePaginator;

class ClientsService implements ClientsServiceInterface
{
    public function list(string $organizationId, array $filters): LengthAwarePaginator
    {
        $organization = Organization::findOrFail($organizationId);

        return ListClients::execute($organization, $filters);
    }

    public function create(string $organizationId, array $data): Client
    {
        $organization = Organization::findOrFail($organizationId);

        return CreateClient::execute($data, $organization);
    }

    public function get(string $clientId): Client
    {
        return GetClient::execute($clientId);
    }

    public function update(string $clientId, array $data): Client
    {
        $client = Client::findOrFail($clientId);

        return UpdateClient::execute($client, $data);
    }

    public function destroy(string $clientId): void
    {
        $client = Client::findOrFail($clientId);

        DeleteClient::execute($client);
    }
}
