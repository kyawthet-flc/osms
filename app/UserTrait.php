<?php

namespace App;

trait UserTrait {
    
    public function hasPermission($appModule, $permissionName)
    {
        // dd($this->cachedPermissions()->where('app_module', strtolower($appModule))->pluck('code', 'name')->toArray());
        return in_array(
            $permissionName, 
            $this->cachedPermissions()->where('app_module', strtolower($appModule))->pluck('code', 'name')->toArray()
        );
    }

}