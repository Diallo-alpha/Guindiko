<?php

namespace App\Policies;

use App\Models\SessionMentorat;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SessionMentoratPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, SessionMentorat $sessionMentorat): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, SessionMentorat $sessionMentorat): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, SessionMentorat $sessionMentorat): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, SessionMentorat $sessionMentorat): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, SessionMentorat $sessionMentorat): bool
    {
        //
    }
}
