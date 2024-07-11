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

    public function isSuperUser(User $user)
    {
        return $user->role === 'superuser'; // Assuming you have a 'role' column in your users table
    }

}
