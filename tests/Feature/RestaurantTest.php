<?php

namespace Tests\Feature;

use Database\Seeders\DatabaseSeeder;
use Database\Seeders\RestraurantSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RestaurantTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_restaurants(): void
    {
        $this->seed(DatabaseSeeder::class);
        $response = $this->getJson('/api/restaurants');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'name',
                    'review' => [
                        'reviews_count',
                        'reviews_average'
                    ],
                    'image'
                ]
            ],
        ]);
    }

    public function test_show_restaurant(): void
    {
        $this->seed(DatabaseSeeder::class);
        $response = $this->getJson('/api/restaurants/1');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'name',
                'description',
                'review' => [],
                'image',
                'categories' => [],
                'location' => [
                    'address',
                    'latitude',
                    'longitude'
                ],
            ]
        ]);
    }

//    public function test_create_restaurant(): void
//    {
//        $this->seed(DatabaseSeeder::class);
//        $response = $this->postJson('/api/restaurants/create');
//    }
}
