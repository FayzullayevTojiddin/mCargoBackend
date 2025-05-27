<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    public function run(): void
    {
        $restaurants = Restaurant::all();
        foreach ($restaurants as $restaurant) {
            ProductCategory::factory()->count(random_int(5, 10))->create([
                'restaurant_id' => $restaurant->id,
            ]);
        }
    }
}
