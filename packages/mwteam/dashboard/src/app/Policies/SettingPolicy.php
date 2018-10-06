<?php

namespace Mwteam\Dashboard\App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SettingPolicy
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

    public function settings(User $user)
    {
        return $user->hasPermission('settings');
    }
}
