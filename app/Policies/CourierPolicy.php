<?php

namespace App\Policies;

use App\Models\Courier;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CourierPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Courier $courier): bool
    {
        return $user->id == $courier->user->id;
    }

    public function create(User $user): bool
    {
        return $user->useRole->code === 'admin';
    }

    public function update(User $user, Courier $courier): bool
    {
        return $user->useRole->code === 'admin';
    }

    public function delete(User $user, Courier $courier): bool
    {
        return $user->useRole->code === 'admin';
    }

    public function restore(User $user, Courier $courier): bool
    {
        return $user->useRole->code === 'admin';
    }

    public function forceDelete(User $user, Courier $courier): bool
    {
        return $user->useRole->code === 'admin';
    }
}
