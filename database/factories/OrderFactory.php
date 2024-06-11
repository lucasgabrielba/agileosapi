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
            'name' => fake()->company(),
            'email' => fake()->companyEmail(),
            'phones' => [fake()->phoneNumber()],
            'document' => fake()->ein(),
            'status' => OrderStatus::ACTIVE->value,
        ];
    }

    public function active(): static
    {
        return $this->state(fn () => ['status' => OrderStatus::ACTIVE->value]);
    }

    public function inactive(): static
    {
        return $this->state(fn () => ['status' => OrderStatus::INACTIVE->value]);
    }
}
