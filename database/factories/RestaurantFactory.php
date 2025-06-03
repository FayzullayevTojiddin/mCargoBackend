<?php

namespace Database\Factories;

use App\Models\Image;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RestaurantFactory extends Factory
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
            'user_id' => User::factory()->create()->id,
            'image_id' => Image::factory()->create()->id,
            'address' => $this->faker->address(),
        ];
    }
}
