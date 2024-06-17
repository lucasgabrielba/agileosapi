<?php

namespace Database\Factories;

use Domains\Orders\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ClientFactory extends Factory
{
    protected $model = Client::class;

    public function definition()
    {
        return [
            'id' => (string) Str::uuid(),
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phones' => [$this->faker->phoneNumber],
            'document' => $this->faker->unique()->numerify('###########'),
            'organization_id' => OrganizationFactory::new()->create()->id,
            'address_id' => AddressFactory::new()->create()->id,
        ];
    }
}
