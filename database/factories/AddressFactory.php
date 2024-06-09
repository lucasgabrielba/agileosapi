<?php

namespace Database\Factories;

use Domains\Shared\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AddressFactory extends Factory
{
    protected $model = Address::class;

    public function definition()
    {
        return [
            'id' => (string) Str::uuid(),
            'street' => fake()->streetName(),
            'number' => fake()->buildingNumber(),
            'complement' => fake()->secondaryAddress(),
            'district' => fake()->citySuffix(),
            'city' => fake()->city(),
            'state' => fake()->state(),
            'country' => fake()->country(),
            'postal_code' => fake()->postcode(),
            'reference' => fake()->sentence(),
        ];
    }
}
