<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CourierTransportFactory extends Factory
{
    public function definition(): array
    {
        return [
            'number' => $this->faker->uuid(),
            'details' => $this->faker->text(),
        ];
    }
}
