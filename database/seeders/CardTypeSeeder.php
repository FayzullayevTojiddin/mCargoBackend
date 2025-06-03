<?php

namespace Database\Seeders;

use App\Models\CardType;
use Illuminate\Database\Seeder;

class CardTypeSeeder extends Seeder
{
    public function run(): void
    {
        CardType::factory()->create([
            'name' => [
                'uz' => "UzCard",
                'ru' => "УзКард"
            ]
        ]);
         CardType::factory()->create([
             'name' => [
                 'uz' => "Humo",
                 'ru' => "Хумо"
             ]
         ]);
         CardType::factory()->create([
             'name' => [
                 'uz' => "Visa",
                 'ru' => "Виза"
             ]
         ]);
    }
}
