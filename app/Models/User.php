<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Mwteam\Dashboard\App\Models\Permission;

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
        'first_name', 'last_name', 'username', 'email', 'password', 'role', 'avatar', 'mobile'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    private $permissions = null;

    //****************************** static methods *****************************

    public static function roles()
    {
        return [
            'super-admin' => 'سوپر ادمین',
            'admin' => 'ادمین',
            'user' => 'کاربر',
        ];
    }

    public static function getAvatar($user){
        if(is_null($user->avatar)){
            return asset('assets/public/images/avatar.jpg');
        }

        return asset('avatars/'.$user->avatar);
    }

    //****************************** relations *************************

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    //****************************** scopes ************************************
    public function scopeAdmins($query)
    {
        return $query->where('role','admin');
    }

    public function scopeAdminOrSuperAdmin($query)
    {
        return $query->where('role','admin')->orWhere('role', 'super-admin');
    }

    public function scopeNotSuperAdmin($query)
    {
        return $query->where('role','!=','super-admin');
    }

    //****************************** methods ************************************
    public function hasPermission($permission)
    {
        if($this->isSuperAdmin()){
            return true;
        }

        if (is_null($this->permissions)) {
            $this->permissions = $this->permissions()->pluck('id','en_title');
        }

        return isset($this->permissions[$permission]) ? true : false;
    }

    public function isAdminOrSuperAdmin(){
        return $this->isAdmin() || $this->isSuperAdmin() ? true:false;
    }

    public function isSuperAdmin(){
        return $this->role == 'super-admin' ? true:false;
    }

    public function isAdmin(){
        return $this->role == 'admin' ? true:false;
    }

    public function isUser(){
        return $this->role == 'user' ? true:false;
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
