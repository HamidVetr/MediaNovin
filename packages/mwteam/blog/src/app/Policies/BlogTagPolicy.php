<?php

namespace Mwteam\Blog\App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlogTagPolicy
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
     * Determine if the user can see tags index page.
     *
     * @param User $user
     * @return bool
     */
    public function index(User $user)
    {
        $blogTagsCreate = $user->hasPermission('blog-tags-create');
        $blogTagsEdit = $user->hasPermission('blog-tags-edit');
        $blogTagsDelete = $user->hasPermission('blog-tags-delete');

        if ($blogTagsCreate || $blogTagsEdit || $blogTagsDelete){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Determine if the user can create tags.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->hasPermission('blog-tags-create');
    }

    /**
     * Determine if the user can edit tags.
     *
     * @param User $user
     * @return bool
     */
    public function edit(User $user)
    {
        return $user->hasPermission('blog-tags-edit');
    }

    /**
     * Determine if the user can delete tags.
     *
     * @param User $user
     * @return bool
     */
    public function delete(User $user)
    {
        return $user->hasPermission('blog-tags-delete');
    }
}
