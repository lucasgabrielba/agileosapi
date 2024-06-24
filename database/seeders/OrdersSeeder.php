<?php

namespace Database\Seeders;

use Database\Factories\ClientFactory;
use Database\Factories\ItemFactory;
use Database\Factories\OrderFactory;
use Domains\Organizations\Models\Organization;
use Domains\Organizations\Models\User;
use Illuminate\Database\Seeder;

class OrdersSeeder extends Seeder
{
    public function run()
    {
        $organization = Organization::first();

        $user = User::first();

        $clients = ClientFactory::new()->count(5)->create([
            'organization_id' => $organization->id,
        ]);

        foreach ($clients as $client) {
            $client->phones()->create([
                'phone_number' => '(11)99999-9999',
            ]);
        }

        $items = ItemFactory::new()->count(10)->create([
            'organization_id' => $organization->id,
            'client_id' => $clients->random()->id,
        ]);

        OrderFactory::new()->count(5)->create([
            'organization_id' => $organization->id,
            'client_id' => $clients->random()->id,
            'user_id' => $user->id,
            'items' => $items->random(2)->pluck('id')->toArray(),
        ]);
    }
}
