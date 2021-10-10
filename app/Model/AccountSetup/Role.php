<?php

namespace App\Model\AccountSetup;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = [];
    
    public static $officerGrpRoleId = 2;

    public static $directorGeneralRoleId = 12;
    public static $deputyDirectorGeneralRoleId = 11;
    public static $directorRoleId = 10;

    public static $labRoleId = 3;
   
    public function users()
    {
        return $this->belongsToMany('App\User', 'role_users');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions');
    }

    public static function arrangeRoles()
    {
        $allRoles = Role::get();

        return [
            'roles' => $allRoles->where('parent_id', 0)->pluck('name', 'id')->toArray(),
            'subRoles' => $allRoles->where('parent_id', '<>', 0)->groupBy('parent_id')->toArray()
        ];
    }
}