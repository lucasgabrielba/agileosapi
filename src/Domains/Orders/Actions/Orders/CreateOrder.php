<?php

namespace Domains\Orders\Actions\Orders;

use Domains\Orders\Actions\Clients\CreateClient;
use Domains\Orders\Actions\Items\CreateItem;
use Domains\Orders\Events\Orders\OrderCreated;
use Domains\Orders\Models\Client;
use Domains\Organizations\Models\Organization;
use Exception;
use Illuminate\Support\Facades\DB;

class CreateOrder
{
    public static function execute(array $data, Organization $organization): array
    {
        DB::beginTransaction();

        try {
            $client = self::getClient($data, $organization);
            $itemsAndProblems = self::getItemsIdsAndProblems($data, $organization, $client);
            $orders = self::createOrders($data, $organization, $client, $itemsAndProblems);

            DB::commit();

            return $orders;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    private static function getClient(array $data, Organization $organization): mixed
    {
        if (isset($data['client_id'])) {
            return $organization->clients()->findOrFail($data['client_id']);
        }

        $client = CreateClient::execute($data['client'], $organization);

        return $client;
    }

    private static function getItemsIdsAndProblems(array $data, Organization $organization, Client $client)
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
                'item_id' => CreateItem::execute($item, $organization, $client)->id,
                'problem_description' => $item['problem_description'] ?? null,
            ];
        }

        return $itemsAndProblems;
    }

    private static function createOrders(array $data, Organization $organization, Client $client, array $itemsAndProblems): array
    {
        $user = auth()->user();
        $orders = [];

        if ($organization->preferences['multiple_items_per_order']) {
            $orders[] = $organization->orders()->create([
                ...$data,
                'client_id' => $client->id,
                'user_id' => $user->id,
                'items' => collect($itemsAndProblems)->pluck('item_id')->toArray(),
            ]);
        } else {
            foreach ($itemsAndProblems as $item) {
                $orders[] = $organization->orders()->create([
                    ...$data,
                    'client_id' => $client->id,
                    'user_id' => $user->id,
                    'items' => [$item['item_id']],
                    'problem_description' => $item['problem_description'],
                ]);
            }
        }

        self::dispatchOrderCreatedEvent($orders, $organization);

        return collect($orders)->pluck('number')->toArray();
    }

    private static function dispatchOrderCreatedEvent(array $orders, Organization $organization): void
    {
        foreach ($orders as $order) {
            event(new OrderCreated($organization->id, $order));
        }
    }
}
