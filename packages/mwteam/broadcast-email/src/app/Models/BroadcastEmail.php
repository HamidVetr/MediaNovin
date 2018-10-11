<?php

namespace Mwteam\BroadcastEmail\App\Models;

use Illuminate\Database\Eloquent\Model;

class BroadcastEmail extends Model
{
    protected $fillable = ['title', 'content', 'users'];
    protected $casts = [
        'users' => 'array',
    ];
}
