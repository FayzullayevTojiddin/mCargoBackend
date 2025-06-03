<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(LoginUserRequest $request): JsonResponse
    {
        $user = User::where('email', $request->get('phone'))->first();
        if(Hash::check($request->get('password'), $user->password)){
            $token = $user->createToken('auth_token')->plainTextToken;
            return $this->success('Login successfully', ['token' => $token]);
        }

        return $this->error(
            'Wrong password or not found user',
        );
    }

    public function logout(Request $request): JsonResponse
    {
        $user = $request->user();
        if($user->currentAccessToken()->delete()){
            return $this->success('Logout successfully');
        }

        return $this->error('Something went wrong');
    }

    public function register(RegisterUserRequest $request): JsonResponse
    {
        $user = User::where('email', $request->get('phone'))->first();
        if($user) {
            return $this->error(
                'User with this phone already exists',
            );
        }

        $newUser = User::create([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('phone'),
            'password' => Hash::make($request->get('password')),
            'user_role_id' => 1
        ]);
        return $this->success(
            'Register successfully',
            ['token' => $newUser->createToken('auth_token')->plainTextToken, 'user' => $newUser], 201
        );
    }

    public function getUser(Request $request): JsonResponse
    {
        $user = auth()->user();
        return $this->response($user->toResource()->toArray(request()));
    }
}
