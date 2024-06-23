<?php

namespace Domains\Orders\Actions\Clients;

use Domains\Orders\Events\Clients\ClientDeleted;
use Domains\Orders\Models\Client;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DeleteClient
{
    public static function execute(string $organizationId, string $clientId): void
    {
        try {
            Client::where('id', $clientId)->delete();

            event(new ClientDeleted($organizationId, $clientId));
        } catch (ModelNotFoundException $e) {
            throw new Exception('Client not found');
        } catch (Exception $e) {
            throw new Exception('An error occurred during the delete: '.$e->getMessage());
        }
    }
}
