<?php

namespace App;

use App\Model\AccountSetup\Role;
use App\Model\Task\Drc\DrcApplication;
use App\Model\Task\Dlmc\{DlmcApplication, Inspection};
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\UserTrait;
use App\Model\Task\Diac\DiacApplication;
use App\Model\SystemLog\LoginoutLog;
use App\Model\Task\Onetime\OnetimeApplication;
class User extends Authenticatable
{
    use Notifiable;
    use UserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    /* protected $fillable = [
        'name', 'login_id', 'email', 'password', 'status'
    ]; */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function loginoutLogs()
    {
        return $this->hasMany(LoginoutLog::class);
    }

    public function roles()
    {
        return $this->belongsToMany('App\Model\AccountSetup\Role', 'role_users');
    }

    public function cachedRoles()
    {
        $key = 'roles_' . $this->id;
        return cache()->rememberForever($key, function () {
            return $this->roles;
        });
    }

   /*  public function singleRole()
    {
        return $this->roles()->first();
    } */

    public function permissions()
    {
        return $this->belongsToMany('App\Model\AccountSetup\Permission', 'permission_users');
    }

    public function cachedPermissions()
    {
        $key = 'permissions_' . $this->id;
        return cache()->rememberForever($key, function () {
            return $this->permissions;
        });

    }

    public function isOfficer()
    {
        return ($this->cachedRoles()->first()->parent_id??0) === 2;
    }

    public function isDirectorGeneral()
    {
        return  $this->isOfficer() && ($this->cachedRoles()->first()->id??0) === Role::$directorGeneralRoleId;
    }

    public function isDeputyDirectorGeneral()
    {
        return  $this->isOfficer() && ($this->cachedRoles()->first()->id??0) === Role::$deputyDirectorGeneralRoleId;
    }

    // to be removed.
    public function isDeputyisDirectorGeneral()
    {
        return  $this->isOfficer() && ($this->cachedRoles()->first()->id??0) === Role::$deputyDirectorGeneralRoleId;
    }

    public function isDirector()
    {
        return  $this->isOfficer() && ($this->cachedRoles()->first()->id??0) === Role::$directorRoleId;
    }

    public function isSuperAdmin()
    {
        return ($this->cachedRoles()->first()->id??0) === 1;
    }

    public function shops()
    {
        return $this->hasMany(\App\Model\Client\Shop::class);
    } 

}
