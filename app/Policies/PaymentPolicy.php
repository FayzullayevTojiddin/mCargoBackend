<?php

namespace App\Policies;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PaymentPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Payment $payment): bool
    {
        return $payment->user_id == $user->id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Payment $payment): bool
    {
        return $user->userRole->code === 'admin';
    }

    public function delete(User $user, Payment $payment): bool
    {
        return $user->userRole->code === 'admin';
    }


    public function restore(User $user, Payment $payment): bool
    {
        return $user->userRole->code === 'admin';
    }

    public function forceDelete(User $user, Payment $payment): bool
    {
        return $user->userRole->code === 'admin';
    }
}
