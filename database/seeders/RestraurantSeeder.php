<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\Restaurant;
use Illuminate\Database\Seeder;

class RestraurantSeeder extends Seeder
{
    public function run(): void
    {
        $restaurans = Restaurant::factory(20)->create();
        foreach ($restaurans as $restauran) {
            $location = Location::factory()->create([
                'locationable_id' => $restauran->id,
                'locationable_type' => Restaurant::class,
            ]);
            $restauran->location()->save($location);
        }
    }
}
