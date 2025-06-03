<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
class CourierTransportTypeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => [
                'en' => $this->faker->word(),
                'ar' => $this->faker->word(),
            ],
            'icon' => $this->faker->imageUrl(),
        ];
    }
}
