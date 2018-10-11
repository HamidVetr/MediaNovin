<?php

namespace Mwteam\BroadcastEmail\App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BroadcastEmailPolicy
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

    public function broadcastEmail(User $user)
    {
        return $user->hasPermission('broadcast-email');
    }
}
