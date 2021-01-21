<?php

namespace App\Policies;

use App\Models\RaceQualiResult;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RaceQualiResultPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RaceQualiResult  $raceQualiResult
     * @return mixed
     */
    public function view(User $user, RaceQualiResult $raceQualiResult)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('manage-races');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RaceQualiResult  $raceQualiResult
     * @return mixed
     */
    public function update(User $user, RaceQualiResult $raceQualiResult)
    {
        return $user->can('manage-races');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RaceQualiResult  $raceQualiResult
     * @return mixed
     */
    public function delete(User $user, RaceQualiResult $raceQualiResult)
    {
        return $user->can('manage-races');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RaceQualiResult  $raceQualiResult
     * @return mixed
     */
    public function restore(User $user, RaceQualiResult $raceQualiResult)
    {
        return $user->can('manage-races');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RaceQualiResult  $raceQualiResult
     * @return mixed
     */
    public function forceDelete(User $user, RaceQualiResult $raceQualiResult)
    {
        return $user->can('manage-races');
    }
}
