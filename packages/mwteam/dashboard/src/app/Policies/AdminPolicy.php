<?php

namespace Mwteam\Dashboard\App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
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

    public function admins(User $user)
    {
        return $user->hasPermission('admins');
    }

    public function adminsCreate(User $user)
    {
        return $user->hasPermission('admins-create');
    }

    public function adminsEdit(User $user)
    {
        return $user->hasPermission('admins-edit');
    }

    public function adminsDelete(User $user)
    {
        return $user->hasPermission('admins-delete');
    }
}
