<?php

namespace Database\Factories;

use Domains\Orders\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    protected $model = Item::class;

    public function definition()
    {
        return [
            'id' => str()->uuid(),
            'type' => $this->faker->word,
            'model' => $this->faker->word,
            'serial' => $this->faker->unique()->numerify('SN########'),
            'brand' => $this->faker->company,
            'client_id' => ClientFactory::new()->create()->id,
            'organization_id' => OrganizationFactory::new()->create()->id,
        ];
    }
}
