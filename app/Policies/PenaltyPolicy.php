<?php

namespace App\Policies;

use App\Models\Penalty;
use App\Models\User;

class PenaltyPolicy
{
    /**
     * Determine whether the user can approve penalties.
     */
    public function approve(User $user, Penalty $penalty): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can view penalties.
     */
    public function view(User $user, Penalty $penalty): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can view all penalties.
     */
    public function viewAny(User $user): bool
    {
        return $user->role === 'admin';
    }
}
