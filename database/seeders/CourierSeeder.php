<?php

namespace Database\Seeders;

use App\Models\Courier;
use App\Models\DeliveryType;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourierSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        foreach ($users as $user) {
            Courier::factory(1)->create([
                'user_id' => $user->id,
            ]);
        }
    }
}
