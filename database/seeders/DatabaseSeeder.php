<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $role = UserRole::create([
            'name' => [
                'en' => 'Admin',
                'uz' => 'Admin',
            ],
            'code' => 'admin',
        ]);

        User::factory()->create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => '+998912361633',
            'user_role_id' => $role->id,
            'password' => bcrypt('As123456'),
        ]);

        $this->call([
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
            CourierSeeder::class,
        ]);
    }
}
