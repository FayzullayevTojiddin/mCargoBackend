<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
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

        $admin = User::factory()->create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => '+998912361633',
            'user_role_id' => $role->id,
            'password' => bcrypt('As123456'),
        ]);

        $admin->location()->save(Location::factory()->create([
            'locationable_id' => $admin->id,
            'locationable_type' => User::class,
        ]));

        $users = User::factory(20)->create();
        foreach ($users as $user) {
            $location = Location::factory()->create([
                'locationable_id' => $user->id,
                'locationable_type' => User::class,
            ]);
            $user->location()->save($location);
        }
    }
}
