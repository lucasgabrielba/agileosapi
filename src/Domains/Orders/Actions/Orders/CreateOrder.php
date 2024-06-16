<?php

namespace Domains\Orders\Actions\Orders;

use Domains\Orders\Actions\Clients\CreateClient;
use Domains\Orders\Actions\Items\CreateItems;
use Domains\Orders\Events\Orders\OrderCreated;
use Domains\Orders\Models\Order;
use Domains\Organizations\Models\Organization;
use Exception;
use Illuminate\Support\Facades\DB;

class CreateOrder
{
    public static function execute(array $data, Organization $organization): Order
    {
        DB::beginTransaction();

        try {

            $client = CreateClient::execute($data['client'], $organization);
            $items = collect(CreateItems::execute($data['items'], $client));

            $orders = [];
            if (! $organization->preferences->multiple_items_per_order) {
                foreach ($items as $item) {
                    $orders[] = $organization->orders()->create([
                        ...$data,
                        'client_id' => $client->id,
                        'items' => [$item->id],
                    ]);
                }
            } else {
                $orders = $organization->orders()->create([
                    ...$data,
                    'client_id' => $client->id,
                    'items' => $items->pluck('id')->toArray(),
                ]);
            }

            foreach ($orders as $order) {
                event(new OrderCreated($organization->id, $order));
            }

            DB::commit();

            return $order;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
