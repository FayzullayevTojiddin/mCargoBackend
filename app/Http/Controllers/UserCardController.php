<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCardStoreRequest;
use App\Http\Resources\UserCardResource;
use App\Models\UserCard;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserCardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }
    public function index(): JsonResponse
    {
        $userCards = UserCardResource::collection(auth()->user()->cards)->toArray(request());
        return $this->response($userCards);
    }

    public function store(UserCardStoreRequest $request): JsonResponse
    {
        $card = UserCard::create([
            'user_id' => auth()->id(),
            ...$request->validated(),
        ]);
        if($card){
            return $this->success(
                message: "User card created", data: $card->toResource()->toArray(request())
            );
        }

        return $this->error(
            message: "User card not created", data: $card->toResource()->toArray(request())
        );
    }

    public function destroy($userCardId): JsonResponse
    {
        $userCard = UserCard::find($userCardId);
        if($userCard?->user?->id === auth()->user()->id and $userCard->delete()){
            return $this->success(
                message: "User card deleted", data: $userCard->toResource()->toArray(request())
            );
        }

        return $this->error(
            message: "User card not deleted"
        );
    }
}
