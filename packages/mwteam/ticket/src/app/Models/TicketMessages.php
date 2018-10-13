<?php

namespace Mwteam\Ticket\App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class TicketMessages extends Model
{
    protected $fillable = ['ticket_id', 'sender', 'message', 'seen', 'sent_from', 'file'];

    //************************* relations *************************

    public function senderWithTrashed()
    {
        return $this->belongsTo(User::class,'sender')->withTrashed();
    }
}
