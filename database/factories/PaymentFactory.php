<?php

namespace Database\Factories;

use App\PaymentStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'total_price' => $this->faker->numberBetween(1000, 99999),
            'status' => PaymentStatus::random()
        ];
    }
}
