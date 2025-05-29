<?php

namespace App\Policies;

use App\Models\DeliveryType;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DeliveryTypePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, DeliveryType $deliveryType): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->userRole->code === 'admin';
    }

    public function update(User $user, DeliveryType $deliveryType): bool
    {
        return $user->userRole->code === 'admin';
    }

    public function delete(User $user, DeliveryType $deliveryType): bool
    {
        return $user->userRole->code === 'admin';
    }

    public function restore(User $user, DeliveryType $deliveryType): bool
    {
        return $user->userRole->code === 'admin';
    }

    public function forceDelete(User $user, DeliveryType $deliveryType): bool
    {
        return $user->userRole->code === 'admin';
    }
}
