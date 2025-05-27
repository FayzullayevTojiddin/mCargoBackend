<?php

namespace Tests\Feature;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_products(): void
    {
        $this->seed(DatabaseSeeder::class);
        $response = $this->getJson('api/restaurant/2/products');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                    '*' => [
                        'id',
                        'name',
                        'description',
                        'net_weight',
                        'image',
                        'review' => [],
                        'price' => [
                            'discount_price',
                            'original_price'
                        ]
                    ]
            ]
        ]);
    }

    public function test_show_product(): void
    {
        $this->seed(DatabaseSeeder::class);
        $response = $this->getJson('api/restaurant/2/products/1');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'description',
                'net_weight',
                'image',
                'review' => [],
                'price' => [
                    'discount_price',
                    'original_price'
                ],
                'options' => [
                    '*' => [
                        'id',
                        'price',
                        'name',
                        'items' => [
                            '*' => [
                                'id',
                                'name',
                                'net_weight',
                            ]
                        ]
                    ]
                ]
            ]
        ]);
    }
}
