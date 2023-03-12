<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WorkoutSection;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class WorkoutSectionPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): Response|bool
    {
        return false;
    }

    public function view(User $user, WorkoutSection $workoutSection): Response|bool
    {
        return false;
    }

    public function create(User $user): Response|bool
    {
        return false;
    }

    public function update(User $user, WorkoutSection $workoutSection): Response|bool
    {
        return false;
    }

    public function delete(User $user, WorkoutSection $workoutSection): Response|bool
    {
        return false;
    }

    public function restore(User $user, WorkoutSection $workoutSection): Response|bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  User  $user
     * @param  WorkoutSection  $workoutSection
     * @return Response|bool
     */
    public function forceDelete(User $user, WorkoutSection $workoutSection): Response|bool
    {
        return false;
    }

    public function before(User $user, $operation): bool
    {
        return (bool) $user->inGroup(env('ADMINISTRATOR_GROUP'));
    }
}
