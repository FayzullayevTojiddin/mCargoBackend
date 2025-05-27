<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => [
                'en' => $this->faker->name(),
                'ar' => $this->faker->name(),
            ],
            'description' => [
                'en' => $this->faker->text(),
                'ar' => $this->faker->text(),
            ],
            'net_weight' => $this->faker->numberBetween(50, 2000),
            'price' => $this->faker->numberBetween(50, 2000),
            'icon' => $this->faker->imageUrl(),
        ];
    }
}
