<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function is_verified(User $user)
    {
        return (bool) $user->is_verified;
    }
}
