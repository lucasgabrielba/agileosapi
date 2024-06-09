<?php

namespace Database\Factories;

use Domains\Organizations\Data\Enums\OrganizationStatus;
use Domains\Organizations\Models\Organization;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrganizationFactory extends Factory
{
    protected $model = Organization::class;

    public function definition()
    {
        return [
            'id' => (string) Str::uuid(),
            'name' => fake()->company(),
            'email' => fake()->companyEmail(),
            'phones' => [fake()->phoneNumber()],
            'document' => fake()->ein(),
            'status' => OrganizationStatus::ACTIVE->value,
        ];
    }

    public function active(): static
    {
        return $this->state(fn () => ['status' => OrganizationStatus::ACTIVE->value]);
    }

    public function inactive(): static
    {
        return $this->state(fn () => ['status' => OrganizationStatus::INACTIVE->value]);
    }
}
