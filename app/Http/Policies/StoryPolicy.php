<?php

namespace App\Policies;

use App\User;
use App\Story;
use Illuminate\Auth\Access\HandlesAuthorization;

class StoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any stories.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
        return true;
    }

    /**
     * Determine whether the user can view the story.
     *
     * @param  \App\User  $user
     * @param  \App\Story  $story
     * @return mixed
     */
    public function view(User $user, Story $story)
    {
        //
    }

    /**
     * Determine whether the user can create stories.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
        return true;
    }

    /**
     * Determine whether the user can update the story.
     *
     * @param  \App\User  $user
     * @param  \App\Story  $story
     * @return mixed
     */
    public function update(User $user, Story $story)
    {
        return $story->user_id == $user->id;
    }

    /**
     * Determine whether the user can delete the story.
     *
     * @param  \App\User  $user
     * @param  \App\Story  $story
     * @return mixed
     */
    public function delete(User $user, Story $story)
    {
        //
    }

    /**
     * Determine whether the user can restore the story.
     *
     * @param  \App\User  $user
     * @param  \App\Story  $story
     * @return mixed
     */
    public function restore(User $user, Story $story)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the story.
     *
     * @param  \App\User  $user
     * @param  \App\Story  $story
     * @return mixed
     */
    public function forceDelete(User $user, Story $story)
    {
        //
    }
}
