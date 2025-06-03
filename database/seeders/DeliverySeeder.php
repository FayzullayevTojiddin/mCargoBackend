<?php

namespace Database\Seeders;

use App\Models\Courier;
use App\Models\Delivery;
use App\Models\DeliveryType;
use App\Models\Location;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeliverySeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $couriers = Courier::all();
        foreach ($users as $user) {
            $randomCourier = $couriers->random();
            $deliveries = Delivery::factory()->count(10)->create([
                'user_id' => $user->id,
                'courier_id' => $randomCourier->id,
                'courier_transport_id' => $randomCourier->courierTransports->random()->id,
            ]);
            foreach ($deliveries as $delivery) {
                $fromLocation = Location::factory()->create([
                    'locationable_id' => $delivery->id,
                    'locationable_type' => Delivery::class,
                ]);
                $toLocation = Location::factory()->create([
                    'locationable_id' => $delivery->id,
                    'locationable_type' => Delivery::class,
                ]);
                $delivery->delivery_from_id = $fromLocation->id;
                $delivery->delivery_to_id = $toLocation->id;
                $delivery->save();
            }
        }
    }
}
