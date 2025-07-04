<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
class CardTypeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'icon' => $this->faker->imageUrl(),
        ];
    }
}
