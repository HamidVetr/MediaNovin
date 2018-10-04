<?php

namespace Mwteam\Ticket\App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketPolicy
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

    public function tickets(User $user)
    {
        return $user->hasPermission('tickets');
    }

    public function ticketsSend(User $user)
    {
        return $user->hasPermission('tickets-send');
    }

    public function ticketsDelete(User $user)
    {
        return $user->hasPermission('tickets-delete');
    }
}
