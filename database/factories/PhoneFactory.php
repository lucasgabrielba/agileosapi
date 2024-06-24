<?php

namespace Database\Factories;

use Domains\Shared\Models\Phone;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PhoneFactory extends Factory
{
    protected $model = Phone::class;

    public function definition()
    {
        return [
            'id' => (string) Str::uuid(),
            'phone_number' => fake()->phoneNumber(),
            'phoneable_id' => null,
            'phoneable_type' => null,
        ];
    }
}
