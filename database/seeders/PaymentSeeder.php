<?php

namespace Database\Seeders;

use App\Models\Payment;
use App\Models\PaymentType;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $paymentTypes = PaymentType::all();
        foreach ($users as $user) {
            $cards = $user->cards()->get();
            Payment::factory(random_int(1, 7))->create([
                'user_id' => $user->id,
                'payment_type_id' => $paymentTypes->random()->id,
                'user_card_id' => $cards->random()->id,
            ]);
        }
    }
}
