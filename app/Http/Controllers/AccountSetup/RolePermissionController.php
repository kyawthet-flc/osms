<?php

namespace App\Http\Controllers\AccountSetup;

use App\Http\Controllers\Controller;
use App\Model\AccountSetup\{ Role, Permission };
use Illuminate\Http\Request;

class RolePermissionController extends Controller
{
    protected $basePath = 'enforcements.account-setups.role-permissions.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Role $role)
    {
        $this->data = array(
            'permissions' => Permission::get(['*'])->groupBy('app_module'),
            'role' => $role,
            'givenPermissions' => $role->permissions->pluck('id')->toArray()
        );
        return $this->viewPath('index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Role $role)
    {
        $permissions = $request->permissions?? [];

        $preparedPermissions = array();

        foreach($permissions as $appType => $permissionObj) {
            foreach($permissionObj as $permissionId) {
                $preparedPermissions[] = $permissionId;
            }
        }

        $role->permissions()->sync($preparedPermissions);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\AccountSetup\RolePermission  $rolePermission
     * @return \Illuminate\Http\Response
     */
    public function show(RolePermission $rolePermission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\AccountSetup\RolePermission  $rolePermission
     * @return \Illuminate\Http\Response
     */
    public function edit(RolePermission $rolePermission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\AccountSetup\RolePermission  $rolePermission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RolePermission $rolePermission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\AccountSetup\RolePermission  $rolePermission
     * @return \Illuminate\Http\Response
     */
    public function destroy(RolePermission $rolePermission)
    {
        //
    }
}
