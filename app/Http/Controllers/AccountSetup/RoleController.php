<?php

namespace App\Http\Controllers\AccountSetup;

use App\Http\Controllers\Controller;
use App\Model\AccountSetup\{ Role, Permission };
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected $basePath = 'enforcements.account-setups.roles.';
    
    public function index()
    {
        $this->data = array(
            'roles' => Role::get(['*'])
        );
        return $this->viewPath('index');
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Role $role)
    {
        //
    }

    public function edit(Role $role)
    {
        //
    }

    public function update(Request $request, Role $role)
    {
        //
    }
    public function destroy(Role $role)
    {
        //
    }
}
