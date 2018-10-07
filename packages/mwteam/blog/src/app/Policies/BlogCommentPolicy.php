<?php

namespace Mwteam\Blog\App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlogCommentPolicy
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
     * Determine if the user can see comments index page.
     *
     * @param User $user
     * @return bool
     */
    public function index(User $user)
    {
        $blogCommentsApprove = $user->hasPermission('blog-comments-approve');
        $blogCommentsEdit = $user->hasPermission('blog-comments-edit');
        $blogCommentsDelete = $user->hasPermission('blog-comments-delete');
        $blogCommentsReply = $user->hasPermission('blog-comments-reply');

        if ($blogCommentsApprove || $blogCommentsEdit || $blogCommentsDelete || $blogCommentsReply){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Determine if the user can approve comments.
     *
     * @param User $user
     * @return bool
     */
    public function approve(User $user)
    {
        return $user->hasPermission('blog-comments-approve');
    }

    /**
     * Determine if the user can edit comments.
     *
     * @param User $user
     * @return bool
     */
    public function edit(User $user)
    {
        return $user->hasPermission('blog-comments-edit');
    }

    /**
     * Determine if the user can delete comments.
     *
     * @param User $user
     * @return bool
     */
    public function delete(User $user)
    {
        return $user->hasPermission('blog-comments-delete');
    }

    /**
     * Determine if the user can reply to comments.
     *
     * @param User $user
     * @return bool
     */
    public function reply(User $user)
    {
        return $user->hasPermission('blog-comments-reply');
    }
}
