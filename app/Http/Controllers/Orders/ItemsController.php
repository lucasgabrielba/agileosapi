<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\Items\CreateItemRequest;
use App\Http\Requests\Orders\Items\UpdateItemRequest;
use Domains\Orders\Contracts\ItemsServiceInterface;
use Domains\Orders\Services\ItemsService;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    protected ItemsServiceInterface $itemsService;

    public function __construct(ItemsService $itemsService)
    {
        $this->itemsService = $itemsService;
    }

    public function index(Request $request, string $organizationId)
    {
        $filters = $request->all();

        $items = $this->itemsService->list($organizationId, $filters);

        return response()->json($items);
    }

    public function store(CreateItemRequest $request, string $organizationId)
    {
        $data = $request->validated();
        $item = $this->itemsService->create($organizationId, $data);

        return response()->json($item, 201);
    }

    public function show(string $organizationId, string $itemId)
    {
        $item = $this->itemsService->get($itemId);

        return response()->json($item);
    }

    public function update(UpdateItemRequest $request, string $organizationId, string $itemId)
    {
        $data = $request->validated();
        $item = $this->itemsService->update($itemId, $data);

        return response()->json($item);
    }

    public function destroy(string $organizationId, string $itemId)
    {
        $this->itemsService->destroy($itemId);

        return response()->json(null, 204);
    }
}
