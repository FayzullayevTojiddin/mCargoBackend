<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
class DeliveryTypeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => [
                'en' => $this->faker->name(),
                'ar' => $this->faker->name(),
            ]
        ];
    }
}
