<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LocationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'city' => $this->faker->city(),
            'state' => $this->faker->streetAddress(),
            'country' => $this->faker->country(),
            'postal_code' => $this->faker->postcode(),
        ];
    }
}
