<?php

namespace Database\Seeders;

use App\Models\CardType;
use App\Models\User;
use App\Models\UserCard;
use Illuminate\Database\Seeder;

class UserCardSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $cardTypes = CardType::all();
        foreach ($users as $user) {
            UserCard::factory()->count(random_int(1, 5))->create([
                'user_id' => $user->id,
                'card_type_id' => $cardTypes->random()->id,
            ]);
        }
    }
}
