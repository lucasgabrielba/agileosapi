<?php

namespace App\Http\Controllers\Organizations;

use App\Http\Controllers\Controller;
use App\Http\Requests\Organizations\Orders\CreateOrderRequest;
use App\Http\Requests\Organizations\Orders\UpdateOrderRequest;
use Domains\Organizations\Contracts\OrdersServiceInterface;
use Domains\Organizations\Services\OrdersService;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    protected OrdersServiceInterface $ordersService;

    public function __construct(OrdersService $ordersService)
    {
        $this->ordersService = $ordersService;
    }

    public function index(Request $request, string $organizationId)
    {
        $filters = $request->all();

        $orders = $this->ordersService->list($organizationId, $filters);

        return response()->json($orders);
    }

    public function store(CreateOrderRequest $request, string $organizationId)
    {
        $data = $request->validated();
        $order = $this->ordersService->create($organizationId, $data);

        return response()->json($order, 201);
    }

    public function show(string $organizationId, string $orderId)
    {
        $order = $this->ordersService->get($orderId);

        return response()->json($order);
    }

    public function update(UpdateOrderRequest $request, string $organizationId, string $orderId)
    {
        $data = $request->validated();
        $order = $this->ordersService->update($orderId, $data);

        return response()->json($order);
    }

    public function destroy(string $organizationId, string $orderId)
    {
        $this->ordersService->destroy($orderId);

        return response()->json(null, 204);
    }
}
