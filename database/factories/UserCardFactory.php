<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserCardFactory extends Factory
{
    public function definition(): array
    {
        return [
            'placeholder_name' => $this->faker->name(),
            'number' => $this->faker->creditCardNumber(),
            'exp_date' => $this->faker->creditCardExpirationDateString(),
            'cvv' => $this->faker->numberBetween(100, 999),
        ];
    }
}
