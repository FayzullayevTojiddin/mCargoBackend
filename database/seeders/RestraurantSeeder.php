<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestraurantSeeder extends Seeder
{
    public function run(): void
    {
        Restaurant::factory(20)->create();
    }
}
