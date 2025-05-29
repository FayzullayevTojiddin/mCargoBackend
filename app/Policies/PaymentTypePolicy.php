<?php

namespace App\Policies;

use App\Models\PaymentType;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PaymentTypePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, PaymentType $paymentType): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->userRole->code === 'admin';
    }

    public function update(User $user, PaymentType $paymentType): bool
    {
        return $user->userRole->code === 'admin';
    }

    public function delete(User $user, PaymentType $paymentType): bool
    {
        return $user->userRole->code === 'admin';
    }

    public function restore(User $user, PaymentType $paymentType): bool
    {
        return $user->userRole->code === 'admin';
    }
    public function forceDelete(User $user, PaymentType $paymentType): bool
    {
        return $user->userRole->code === 'admin';
    }
}
