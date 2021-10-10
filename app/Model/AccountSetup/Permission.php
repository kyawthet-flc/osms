<?php

namespace App\Model\AccountSetup;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany('App\User', 'permission_users');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permissions');
    }
}
