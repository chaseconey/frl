<?php

namespace App\Policies;

use App\Models\BroadcastVideo;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BroadcastVideoPolicy
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
     * @param  \App\Models\BroadcastVideo  $broadcastVideo
     * @return mixed
     */
    public function view(User $user, BroadcastVideo $broadcastVideo)
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
        return $user->can('manage-broadcasts');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BroadcastVideo  $broadcastVideo
     * @return mixed
     */
    public function update(User $user, BroadcastVideo $broadcastVideo)
    {
        return $user->can('manage-broadcasts');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BroadcastVideo  $broadcastVideo
     * @return mixed
     */
    public function delete(User $user, BroadcastVideo $broadcastVideo)
    {
        return $user->can('manage-broadcasts');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BroadcastVideo  $broadcastVideo
     * @return mixed
     */
    public function restore(User $user, BroadcastVideo $broadcastVideo)
    {
        return $user->can('manage-broadcasts');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BroadcastVideo  $broadcastVideo
     * @return mixed
     */
    public function forceDelete(User $user, BroadcastVideo $broadcastVideo)
    {
        return $user->can('manage-broadcasts');
    }
}
