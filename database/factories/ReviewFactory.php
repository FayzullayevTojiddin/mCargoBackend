<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    public function definition(): array
    {
        return [
            'comment' => $this->faker->words(5, true),
            'score' => (string) $this->faker->numberBetween(1, 5),
        ];
    }
}
