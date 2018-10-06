<?php

namespace Mwteam\Ticket\App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['user_id', 'title', 'status'];
    public static $ticketFilePath = 'files/tickets/';

    protected static $statuses = [
        'in-queue' => 'در صف بررسی',
        'in-progress' => 'در حال بررسی',
        'answered' => 'پاسخ داده شده',
        'closed' => 'بسته شده',
    ];

    public static function statuses(){
        return static::$statuses;
    }

    public function messages()
    {
        return $this->hasMany(TicketMessages::class);
    }

    public function userWithTrashed()
    {
        return $this->belongsTo(User::class,'user_id')->withTrashed();
    }
}
