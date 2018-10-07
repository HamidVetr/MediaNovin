<?php

namespace Mwteam\Blog\App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlogArticlePolicy
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
    public function blog(User $user)
    {
        return $user->hasPermission('blog');
    }

    /**
     * Determine if the user can see articles index page.
     *
     * @param User $user
     * @return bool
     */
    public function index(User $user)
    {
        $blogArticlesCreate = $user->hasPermission('blog-articles-create');
        $blogArticlesEdit = $user->hasPermission('blog-articles-edit');
        $blogArticlesDelete = $user->hasPermission('blog-articles-delete');

        if ($blogArticlesCreate || $blogArticlesEdit || $blogArticlesDelete){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Determine if the user can create articles.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->hasPermission('blog-articles-create');
    }

    /**
     * Determine if the user can edit articles.
     *
     * @param User $user
     * @return bool
     */
    public function edit(User $user)
    {
        return $user->hasPermission('blog-articles-edit');
    }

    /**
     * Determine if the user can delete articles.
     *
     * @param User $user
     * @return bool
     */
    public function delete(User $user)
    {
        return $user->hasPermission('blog-articles-delete');
    }
}
