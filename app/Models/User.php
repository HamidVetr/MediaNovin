<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Mwteam\Dashboard\Models\Permission;

/**
 * App\Models\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $fillable = [
        'first_name', 'last_name', 'username', 'email', 'password', 'role', 'deactivated_at'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected static $roles = [
        1 => 'ادمین',
        2 => 'کاربر',
    ];

    private $permissions = null;

    //****************************** relations *************************

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    //****************************** scopes ************************************
    public function scopeAdmins($query)
    {
        return $query->where('role',1)->where('id','!=',1);
    }

    //****************************** methods ************************************
    public function hasPermission($permission)
    {
        if (is_null($this->permissions)) {
            $this->permissions = $this->permissions()->pluck('id','eng_title');
        }

        return isset($this->permissions[$permission]) ? true:false;
    }

    public function isAdmin(){
        return $this->role == 1 ? true:false;
    }

    public function isUser(){
        return $this->role == 2 ? true:false;
    }
}
