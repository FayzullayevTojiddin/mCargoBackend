<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            RestraurantSeeder::class,
            ReviewSeeder::class,
            ProductCategorySeeder::class,
            ProductSeeder::class,
            ProductOptionSeeder::class,
            ProductOptionItemSeeder::class,
            CardTypeSeeder::class,
            UserCardSeeder::class,
            PaymentTypeSeeder::class,
            PaymentSeeder::class,
            DeliveryTypeSeeder::class,
            CourierTransportTypeSeeder::class,
            CourierSeeder::class,
            CourierTransportSeeder::class,
            DeliverySeeder::class,
        ]);
    }
}
