<?php

namespace Database\Seeders;

use App\Models\Courier;
use App\Models\DeliveryType;
use App\Models\Location;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourierSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        foreach ($users as $user) {
            $courier = Courier::factory()->create([
                'user_id' => $user->id,
            ]);
            $location = Location::factory()->make();
            $courier->location()->save($location);
        }
    }
}
