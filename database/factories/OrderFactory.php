<?php

namespace Database\Factories;

use Domains\Orders\Data\Enums\OrderStatus;
use Domains\Orders\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        return [
            'id' => (string) Str::uuid(),
            'number' => $this->faker->unique()->numberBetween(1, 1000),
            'status' => OrderStatus::OPEN,
            'items' => ItemFactory::new()->count($this->faker->numberBetween(1, 5))->create()->pluck('id')->toArray(),
            'problem_description' => $this->faker->sentence,
            'budget_description' => $this->faker->sentence,
            'internal_notes' => $this->faker->paragraph,
            'order_history' => json_encode([
                [
                    'message' => 'Ordem de Serviço criada',
                    'author' => $this->faker->name,
                    'date' => now()->toDateTimeString(),
                ],
            ]),
            'closed_at' => null,
            'estimated_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'end_of_warranty_date' => $this->faker->dateTimeBetween('now', '+3 month'),
            'is_reentry' => false,
            'priority' => $this->faker->randomElement(['normal', 'high']),
            'client_id' => ClientFactory::new()->create()->id,
            'organization_id' => OrganizationFactory::new()->create()->id,
            'user_id' => UserFactory::new()->create()->id,
        ];
    }
}
