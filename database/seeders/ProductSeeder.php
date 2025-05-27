<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Restaurant;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $restaurants = Restaurant::all();
        $users = User::all();
        foreach ($restaurants as $restaurant) {
            $categories = $restaurant->categories;
            foreach ($categories as $category) {
                Product::factory()->create([
                    'restaurant_id' => $restaurant->id,
                    'product_category_id' => $category->id,
                ]);
            }
            $products = $restaurant->products;
            foreach ($products as $product) {
                foreach($users as $user) {
                    Review::factory(1)->create([
                        'reviewable_id' => $product->id,
                        'reviewable_type' => Product::class,
                        'user_id' => $user->id,
                    ]);
                }
            }
        }
    }
}
