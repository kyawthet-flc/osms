<?php

namespace App\Http\Controllers\AccountSetup;

use App\Http\Controllers\Controller;
use App\Model\AccountSetup\Permission;
use App\User;
use Illuminate\Http\Request;

class UserPermissionController extends Controller
{
    protected $basePath = 'enforcements.account-setups.user-permissions.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $adminUser)
    {
        // dd( $adminUser->isLabAdmin(), $adminUser->isOfficer() );
        $appModules = array('diac', 'drc', 'drc-local', 'dlmc', 'onetime');

        if( $adminUser->isLabAdmin() ) {
            $appModules = array('drc-lab', 'drc-local-lab');
        }

        $this->data = array(
            'permissions' => Permission::whereIn('app_module', $appModules)->get(['*'])->groupBy('app_module'),
            'adminUser' => $adminUser,
            'givenPermissions' => $adminUser->permissions->pluck('id')->toArray()
        );
        return $this->viewPath('index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $adminUser)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $adminUser)
    {
        $permissions = $request->permissions?? [];

        $preparedPermissions = array();

        foreach($permissions as $appType => $permissionObj) {
            foreach($permissionObj as $permissionId) {
                $preparedPermissions[] = $permissionId;
            }
        }

        $adminUser->permissions()->sync($preparedPermissions);

        // Delete All Cached Permissions and Roles
        cache()->forget('permissions_' . $adminUser->id);
        cache()->forget('roles' . $adminUser->id);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\AccountSetup\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\AccountSetup\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\AccountSetup\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\AccountSetup\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        //
    }
}
