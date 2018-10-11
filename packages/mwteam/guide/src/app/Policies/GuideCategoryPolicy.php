<?php

namespace Mwteam\Guide\App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GuideCategoryPolicy
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
     * Determine if the user can see categories index page.
     *
     * @param User $user
     * @return bool
     */
    public function index(User $user)
    {
        $guideCategoriesCreate = $user->hasPermission('guide-categories-create');
        $guideCategoriesEdit = $user->hasPermission('guide-categories-edit');
        $guideCategoriesDelete = $user->hasPermission('guide-categories-delete');

        if ($guideCategoriesCreate || $guideCategoriesEdit || $guideCategoriesDelete){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Determine if the user can create categories.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->hasPermission('guide-categories-create');
    }

    /**
     * Determine if the user can edit categories.
     *
     * @param User $user
     * @return bool
     */
    public function edit(User $user)
    {
        return $user->hasPermission('guide-categories-edit');
    }

    /**
     * Determine if the user can delete categories.
     *
     * @param User $user
     * @return bool
     */
    public function delete(User $user)
    {
        return $user->hasPermission('guide-categories-delete');
    }
}
