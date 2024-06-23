<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\Clients\CreateClientRequest;
use App\Http\Requests\Orders\Clients\UpdateClientRequest;
use Domains\Orders\Contracts\ClientsServiceInterface;
use Domains\Orders\Services\ClientsService;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    protected ClientsServiceInterface $clientsService;

    public function __construct(ClientsService $clientsService)
    {
        $this->clientsService = $clientsService;
    }

    public function index(Request $request, string $organizationId)
    {
        $filters = $request->all();

        $clients = $this->clientsService->list($organizationId, $filters);

        return response()->json($clients);
    }

    public function store(CreateClientRequest $request, string $organizationId)
    {
        $data = $request->validated();
        $client = $this->clientsService->create($organizationId, $data);

        return response()->json($client, 201);
    }

    public function show(string $organizationId, string $clientId)
    {
        $client = $this->clientsService->get($clientId);

        return response()->json($client);
    }

    public function update(UpdateClientRequest $request, string $organizationId, string $clientId)
    {
        $data = $request->validated();
        $this->clientsService->update($organizationId, $clientId, $data);

        return response()->json([
            'message' => 'Client updated successfully',
        ]);
    }

    public function destroy(string $organizationId, string $clientId)
    {
        $this->clientsService->destroy($organizationId, $clientId);

        return response()->json([
            'message' => 'Client deleted successfully',
        ], 204);
    }
}
