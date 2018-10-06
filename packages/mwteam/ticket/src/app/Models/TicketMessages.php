<?php

namespace Mwteam\Ticket\App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketMessages extends Model
{
    protected $fillable = ['ticket_id', 'sender', 'message', 'seen', 'file'];
}
