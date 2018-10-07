<?php

namespace Mwteam\Blog\App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlogCategoryPolicy
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
        $blogCategoriesCreate = $user->hasPermission('blog-categories-create');
        $blogCategoriesEdit = $user->hasPermission('blog-categories-edit');
        $blogCategoriesDelete = $user->hasPermission('blog-categories-delete');

        if ($blogCategoriesCreate || $blogCategoriesEdit || $blogCategoriesDelete){
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
        return $user->hasPermission('blog-categories-create');
    }

    /**
     * Determine if the user can edit categories.
     *
     * @param User $user
     * @return bool
     */
    public function edit(User $user)
    {
        return $user->hasPermission('blog-categories-edit');
    }

    /**
     * Determine if the user can delete categories.
     *
     * @param User $user
     * @return bool
     */
    public function delete(User $user)
    {
        return $user->hasPermission('blog-categories-delete');
    }
}
