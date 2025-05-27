<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
class OrderProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'number' => $this->faker->uuid(),
            'total_price' => $this->faker->randomFloat(2, 10),
            'net_weight' => $this->faker->randomFloat(2, 10),
            'notes' => $this->faker->text(),
        ];
    }
}
