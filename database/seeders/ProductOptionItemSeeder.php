<?php

namespace Database\Seeders;

use App\Models\ProductOption;
use App\Models\ProductOptionItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductOptionItemSeeder extends Seeder
{
    public function run(): void
    {
        $options = ProductOption::all();
        foreach ($options as $option) {
            ProductOptionItem::factory(random_int(1, 6))->create([
                'product_option_id' => $option->id,
            ]);
        }
    }
}
