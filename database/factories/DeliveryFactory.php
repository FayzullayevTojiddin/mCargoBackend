<?php

namespace Database\Factories;

use App\DeliveryStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeliveryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'number' => $this->faker->uuid(),
            'delivery_at' => $this->faker->dateTime(),
            'price' => $this->faker->randomFloat(2, 10),
            'status' => DeliveryStatus::random(),
        ];
    }
}
