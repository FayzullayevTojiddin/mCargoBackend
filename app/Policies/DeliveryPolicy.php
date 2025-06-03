<?php

namespace App\Policies;

use App\Models\Delivery;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DeliveryPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Delivery $delivery): bool
    {
        return $user->id == $delivery->user_id;
    }

    public function create(User $user): bool
    {
        return $user->userRole->code === 'admin';
    }

    public function update(User $user, Delivery $delivery): bool
    {
        return $user->userRole->code === 'admin';
    }

    public function delete(User $user, Delivery $delivery): bool
    {
        return $user->userRole->code === 'admin';
    }

    public function restore(User $user, Delivery $delivery): bool
    {
        return $user->userRole->code === 'admin';
    }

    public function forceDelete(User $user, Delivery $delivery): bool
    {
        return $user->userRole->code === 'admin';
    }
}
