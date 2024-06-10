<?php

namespace App\Http\Controllers\Organizations;

use App\Http\Controllers\Controller;
use App\Http\Requests\Organizations\Organizations\CreateOrganizationRequest;
use App\Http\Requests\Organizations\Organizations\UpdateOrganizationRequest;
use Domains\Organizations\Contracts\OrganizationsServiceInterface;
use Domains\Organizations\Services\OrganizationsService;

class OrganizationsController extends Controller
{
    protected OrganizationsServiceInterface $organizationsService;

    public function __construct(OrganizationsService $organizationsService)
    {
        $this->organizationsService = $organizationsService;
    }

    public function index()
    {
        $organizations = $this->organizationsService->list();

        return response()->json($organizations);
    }

    public function store(CreateOrganizationRequest $request)
    {
        $data = $request->validated();
        $organization = $this->organizationsService->create($data);

        return response()->json($organization, 201);
    }

    public function show($organizationId)
    {
        $organization = $this->organizationsService->getOne($organizationId);

        return response()->json($organization);
    }

    public function update(UpdateOrganizationRequest $request, $organizationId)
    {
        $data = $request->validated();
        $organization = $this->organizationsService->update($organizationId, $data);

        return response()->json($organization);
    }

    public function destroy($organizationId)
    {
        $this->organizationsService->destroy($organizationId);

        return response()->json(null, 204);
    }
}
