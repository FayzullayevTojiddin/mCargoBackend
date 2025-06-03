<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserCardFactory extends Factory
{
    public function definition(): array
    {
        return [
            'masked_number' => $this->maskCardNumber($this->faker->creditCardNumber()),
            'exp_date' => $this->faker->creditCardExpirationDateString(),
            'token' => $this->faker->uuid(),
            'verified' => $this->faker->boolean(),
        ];
    }

    function maskCardNumber(string $number): string
    {
        return substr($number, 0, 4) . str_repeat('*', strlen($number) - 8) . substr($number, -4);
    }
}
