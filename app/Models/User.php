<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\Client;
use App\Notifications\SentEmailResetPassword;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function returnRoleUser($idUser)
    {
        $roleId = RoleUser::where('user_id',$idUser)->get();

        return $roleId[0]->role_id;
    }

    public function returnNameRole($idUser)
    {
        $idRole = RoleUser::where('user_id',$idUser)->get();

        $roleName = Role::find($idRole[0]->role_id)->label;

        return $roleName;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasPermission(Permission $permission)
    {
        return $this->hasAnyRoles($permission->roles);
    }

    public function hasAnyRoles($roles)
    {
        if (is_array($roles) || is_object($roles)) {
            return !! $roles->intersect($this->roles)->count();
        }

        return $this->roles->contains('name', $roles);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new SentEmailResetPassword($token));
    }

}
