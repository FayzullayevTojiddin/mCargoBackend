<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\UserRole;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_user_login(): void
    {
        $randNumberPhone = rand(1111111111,999999999);
        $password = 'As123456';
        $role = UserRole::create([
            'name' => [
                'ar' => 'Admin AR',
                'en' => 'Admin EN'
            ],
            'code' => 'admin'
        ]);
        User::factory()->create([
            'email' => $randNumberPhone,
            'password' => bcrypt($password),
            'user_role_id' => $role->id
        ]);
        $response = $this->postJson('/api/login', [
            'phone' => $randNumberPhone,
            'password' => $password,
        ]);
        $response->assertStatus(201);
        $response->assertJsonStructure([
            'data' => ['token']
        ]);

        $response = $this->postJson('/api/login', [
            'phone' => $randNumberPhone,
            'password' => 'incorrect password',
        ]);
        $response->assertStatus(401);
    }

    public function test_can_user_logout(): void
    {
        $randNumberPhone = rand(1111111111,999999999);
        $password = 'As123456';
        $role = UserRole::create([
            'name' => [
                'ar' => 'Admin AR',
                'en' => 'Admin EN'
            ],
            'code' => 'admin'
        ]);
        $user = User::factory()->create([
            'email' => $randNumberPhone,
            'password' => bcrypt($password),
            'user_role_id' => $role->id
        ]);
        $token = $user->createToken('auth_token');
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token->plainTextToken,
        ])->postJson('/api/logout', []);
        $response->assertStatus(201);
        $this->assertDatabaseMissing('personal_access_tokens', [
            'id' => $token->accessToken->id,
        ]);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . 'not token',
        ])->postJson('/api/logout', []);
        $response->assertStatus(401);
    }

    public function test_can_user_register(): void
    {
        $this->seed(DatabaseSeeder::class);
        $randNumberPhone = rand(1111111111,999999999);
        $password = 'As123456';
        $response = $this->postJson('/api/register', [
            'phone' => $randNumberPhone,
            'password' => $password,
            'confirm_password' => $password,
            'first_name' => 'Test',
            'last_name' => 'User',
        ]);
        $response->assertStatus(201);
        $response->assertJsonStructure([
            'data' => ['token', 'user']
        ]);
    }

    public function test_can_get_user(): void
    {
        $this->seed(DatabaseSeeder::class);
        $user = User::find(1);
        $token = $user->createToken('auth_token');
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token->plainTextToken,
        ])->getJson('/api/user', []);
        $response->assertStatus(200);
    }
}
