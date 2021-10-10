<?php

namespace App\Model\AccountSetup;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class RoleUser extends Pivot
{
    protected $table = 'role_users';

    protected $guarded = [];

    // Get Director ID
    public static function getDirectorId()
    {
        return self::whereRoleId(Role::$directorRoleId)->latest()->first()->id?? 0;
    }
    
    // Get DG or DDG IDS
    public static function getDgOrddgIds()
    {
        return self::whereIn('role_id',[Role::$directorGeneralRoleId, Role::$deputyDirectorGeneralRoleId])->pluck('id')->toArray();
    }
}

/* 
  public static $directorGeneralRoleId = 12;
    public static $deputyDirectorGeneralRoleId = 11;
    public static $directorRoleId = 10;
*/