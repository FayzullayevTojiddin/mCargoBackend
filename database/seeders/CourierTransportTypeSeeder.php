<?php

namespace Database\Seeders;

use App\Models\CourierTransportType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourierTransportTypeSeeder extends Seeder
{
    public function run(): void
    {
        CourierTransportType::factory()->count(10)->create();
    }
}
