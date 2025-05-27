<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Restaurant;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::factory(20)->create();
        $restaurants = Restaurant::all();
        foreach ($restaurants as $restaurant) {
            foreach ($users as $user) {
                Review::factory()->create([
                    'reviewable_id' => $restaurant->id,
                    'reviewable_type' => Restaurant::class,
                    'user_id' => $user->id,
                ]);
            }
        }
    }
}
