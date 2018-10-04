<?php

namespace Mwteam\Dashboard\App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public function parentItem()
    {
        return $this->belongsTo(Permission::class,'parent','en_title');
    }
}
