<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\Orders\CreateOrderRequest;
use App\Http\Requests\Orders\Orders\UpdateOrderRequest;
use Domains\Orders\Contracts\OrdersServiceInterface;
use Domains\Orders\Services\OrdersService;
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
        $orders = $this->ordersService->create($organizationId, $data);

        return response()->json($orders, 201);
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
