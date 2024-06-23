<?php

namespace Domains\Orders\Actions\Clients;

use Domains\Orders\Events\Clients\ClientUpdated;
use Domains\Orders\Models\Client;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateClient
{
    public static function execute(string $organizationId, string $clientId, array $data): void
    {
        try {
            Client::where('id', $clientId)->update($data);

            event(new ClientUpdated($organizationId, $clientId));
        } catch (ModelNotFoundException $e) {
            throw new Exception('Client not found');
        } catch (Exception $e) {
            throw new Exception('An error occurred during the update: '.$e->getMessage());
        }
    }
}
