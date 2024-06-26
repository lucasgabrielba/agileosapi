<?php

namespace Domains\Orders\Actions\Orders;

use Domains\Orders\Actions\Clients\CreateClient;
use Domains\Orders\Actions\Items\CreateItem;
use Domains\Orders\Events\Orders\OrderCreated;
use Domains\Orders\Models\Order;
use Domains\Organizations\Models\Organization;
use Exception;
use Illuminate\Support\Facades\DB;

class CreateOrder
{
    public static function execute(array $data, string $organizationId): array
    {
        DB::beginTransaction();

        try {
            $clientId = self::getClient($data, $organizationId);
            $itemsAndProblems = self::getItemsIdsAndProblems($data, $organizationId, $clientId);
            $orders = self::createOrders($data, $organizationId, $clientId, $itemsAndProblems);

            DB::commit();

            return $orders;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    private static function getClient(array $data, string $organizationId): mixed
    {
        if (isset($data['client_id'])) {
            return $data['client_id'];
        }

        $client = CreateClient::execute($data['client'], $organizationId);

        return $client->id;
    }

    private static function getItemsIdsAndProblems(array $data, string $organizationId, string $clientId)
    {
        $itemsAndProblems = [];

        foreach ($data['items'] as $item) {
            if (isset($item['id'])) {
                $itemsAndProblems[] = [
                    'item_id' => $item['id'],
                    'problem_description' => $item['problem_description'] ?? null,
                ];

                continue;
            }

            $itemsAndProblems[] = [
                'item_id' => CreateItem::execute($organizationId, $clientId, $item)->id,
                'problem_description' => $item['problem_description'] ?? null,
            ];
        }

        return $itemsAndProblems;
    }

    private static function createOrders(array $data, string $organizationId, string $clientId, array $itemsAndProblems): array
    {
        $user = auth()->user();
        $orders = [];

        $organization = Organization::where('id', $organizationId)
            ->select('preferences')->first();

        if ($organization->preferences['multiple_items_per_order']) {
            $orders[] = Order::create([
                ...$data,
                'client_id' => $clientId,
                'user_id' => $user->id,
                'items' => collect($itemsAndProblems)->pluck('item_id')->toArray(),
                'organization_id' => $organizationId,
            ]);
        } else {
            foreach ($itemsAndProblems as $item) {
                $orders[] = Order::create([
                    ...$data,
                    'client_id' => $clientId,
                    'user_id' => $user->id,
                    'items' => [$item['item_id']],
                    'problem_description' => $item['problem_description'],
                    'organization_id' => $organizationId,
                ]);
            }
        }

        self::dispatchOrderCreatedEvent($orders, $organizationId);

        return collect($orders)->pluck('number')->toArray();
    }

    private static function dispatchOrderCreatedEvent(array $orders, string $organizationId): void
    {
        foreach ($orders as $order) {
            event(new OrderCreated($organizationId, $order->id));
        }
    }
}
