<?php

namespace Mwteam\Dashboard\App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable=['id','data'];
    public $incrementing=false;
}
