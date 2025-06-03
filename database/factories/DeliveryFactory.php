<?php

namespace Database\Factories;

use App\DeliveryStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeliveryFactory extends Factory
{
    public function definition(): array
    {
        $minSeconds = $this->faker->numberBetween(1800, 2400);
        $maxSeconds = $this->faker->numberBetween($minSeconds, 3600);

        return [
            'number' => $this->faker->uuid(),
            'delivery_at' => $this->faker->dateTime(),
            'price' => $this->faker->randomFloat(2, 10),
            'status' => DeliveryStatus::random(),
            'estimated_time_sec_min' => $minSeconds,
            'estimated_time_sec_max' => $maxSeconds,
        ];
    }
}
