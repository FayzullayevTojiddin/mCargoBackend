<?php

namespace Database\Seeders;

use App\Models\Courier;
use App\Models\CourierTransport;
use App\Models\CourierTransportType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourierTransportSeeder extends Seeder
{
    public function run(): void
    {
        $couriers = Courier::all();
        $courierTransportTypes = CourierTransportType::all();
        foreach ($couriers as $courier) {
            CourierTransport::factory()->create([
                'courier_id' => $courier->id,
                'courier_transport_type_id' => $courierTransportTypes->random()->id,
            ]);
        }
    }
}
