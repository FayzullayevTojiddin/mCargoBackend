<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
class CourierFactory extends Factory
{
    public function definition(): array
    {
        return [
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
        ];
    }
}
