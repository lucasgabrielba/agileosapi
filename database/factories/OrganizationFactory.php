<?php

namespace Database\Factories;

use Domains\Organizations\Enums\OrganizationStatus;
use Domains\Organizations\Models\Organization;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrganizationFactory extends Factory
{
    protected $model = Organization::class;

    public function definition()
    {
        return [
            'id' => str()->uuid(),
            'name' => fake()->company(),
            'email' => fake()->companyEmail(),
            'phones' => [fake()->phoneNumber()],
            'document' => fake()->ein(),
            'status' => OrganizationStatus::ACTIVE,
        ];
    }

    public function active(): static
    {
        return $this->state(fn () => ['status' => OrganizationStatus::ACTIVE]);
    }

    public function inactive(): static
    {
        return $this->state(fn () => ['status' => OrganizationStatus::INACTIVE]);
    }
}
