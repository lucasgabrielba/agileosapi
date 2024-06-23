<?php

namespace Domains\Orders\Contracts;

use Domains\Orders\Models\Client;
use Illuminate\Pagination\LengthAwarePaginator;

interface ClientsServiceInterface
{
    public function list(string $organizationId, array $filters): LengthAwarePaginator;

    public function create(string $organizationId, array $data): Client;

    public function get(string $clientId): Client;

    public function update(string $organizationId, string $clientId, array $data): void;

    public function destroy(string $organizationId, string $clientId): void;
}
