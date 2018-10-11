<?php

namespace Mwteam\Guide\App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GuidePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the user can see blog section in the sidebar.
     *
     * @param User $user
     * @return bool
     */
    public function guide(User $user)
    {
        return $user->hasPermission('guide');
    }

    /**
     * Determine if the user can see guides index page.
     *
     * @param User $user
     * @return bool
     */
    public function index(User $user)
    {
        $guidesCreate = $user->hasPermission('guides-create');
        $guidesEdit = $user->hasPermission('guides-edit');
        $guidesDelete = $user->hasPermission('guides-delete');

        if ($guidesCreate || $guidesEdit || $guidesDelete){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Determine if the user can create guides.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->hasPermission('guide-create');
    }

    /**
     * Determine if the user can edit guides.
     *
     * @param User $user
     * @return bool
     */
    public function edit(User $user)
    {
        return $user->hasPermission('guide-edit');
    }

    /**
     * Determine if the user can delete guides.
     *
     * @param User $user
     * @return bool
     */
    public function delete(User $user)
    {
        return $user->hasPermission('guide-delete');
    }
}
