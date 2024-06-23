<?php

namespace Domains\Orders\Services;

use Domains\Orders\Actions\Clients\CreateClient;
use Domains\Orders\Actions\Clients\DeleteClient;
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
        return Client::findOrFail($clientId);
    }

    public function update(string $organizationId, string $clientId, array $data): void
    {
        return UpdateClient::execute($organizationId, $clientId, $data);
    }

    public function destroy(string $organizationId, string $clientId): void
    {
        DeleteClient::execute($organizationId, $clientId);
    }
}
