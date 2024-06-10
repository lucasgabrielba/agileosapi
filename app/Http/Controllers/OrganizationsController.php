<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrganizationRequest;
use App\Http\Requests\UpdateOrganizationRequest;
use App\Services\OrganizationsServiceInterface;

class OrganizationsController extends Controller
{
    protected OrganizationsServiceInterface $organizationsService;

    public function __construct(OrganizationsServiceInterface $organizationsService)
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
