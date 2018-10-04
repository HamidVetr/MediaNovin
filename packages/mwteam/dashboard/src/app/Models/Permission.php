<?php

namespace Mwteam\Dashboard\App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['fa_title', 'en_title', 'parent'];

    public function parentItem()
    {
        return $this->belongsTo(Permission::class,'parent','en_title');
    }
}
