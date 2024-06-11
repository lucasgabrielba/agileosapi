<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Http\Requests\Organizations\Clients\CreateClientRequest;
use App\Http\Requests\Organizations\Clients\UpdateClientRequest;
use Domains\Organizations\Contracts\ClientsServiceInterface;
use Domains\Organizations\Services\ClientsService;
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
        $client = $this->clientsService->update($clientId, $data);

        return response()->json($client);
    }

    public function destroy(string $organizationId, string $clientId)
    {
        $this->clientsService->destroy($clientId);

        return response()->json(null, 204);
    }
}
