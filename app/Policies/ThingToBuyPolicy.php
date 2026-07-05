<?php

namespace App\Policies;

use App\Models\ThingToBuy;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ThingToBuyPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ThingToBuy $thingToBuy): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ThingToBuy $thing)
    {
        return $thing->smash->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ThingToBuy $thingToBuy): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ThingToBuy $thingToBuy): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ThingToBuy $thingToBuy): bool
    {
        return false;
    }
}
