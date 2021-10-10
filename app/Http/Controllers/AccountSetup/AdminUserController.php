<?php

namespace App\Http\Controllers\AccountSetup;

use App\Http\Controllers\Controller;
use App\User;
use App\Model\AccountSetup\Role;
use Illuminate\Http\Request;
use App\Http\Requests\AccountSetup\AdminUserRequest;
use DB;
// \Schema::getColumnListing('users')

class AdminUserController extends Controller
{
    protected $basePath = 'enforcements.account-setups.admin-users.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data = array(
            'adminUsers' => User::with(['roles'])->get(['id', 'name', 'login_id', 'email', 'status'])
        );
        return $this->viewPath('index');
    }
    

    public function create()
    {
        $this->data = ['user' => new User ] + Role::arrangeRoles();
        return $this->viewPath('create');
    }

    public function store(AdminUserRequest $request)
    {
        try {                
            $isCreatedUser = User::create([
                'name' => $request->name,
                'login_id' => strtolower(replace_space_with_dash($request->name)),
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'status' => $request->status,
            ]);
            $isCreatedUser->roles()->sync( array($request->sub_role?? $request->role) );
            
         } catch (\Throwable $th) {
             //throw $th;
            //  dd($th->getMessage() );
         return back()->with('error', $th->getMessage()/*'Error when creating an office user.'*/);
         }
         
         return back()->with('success', 'Successfully Created.');

    }

    public function show(User $adminUser)
    {
        $this->data = array('user' => $adminUser);
        return $this->viewPath('show');
    }
 
    public function edit(User $adminUser)
    {
        $this->data = ['user' => $adminUser ] + Role::arrangeRoles();
        return $this->viewPath('edit');
    }

    public function update(AdminUserRequest $request, User $adminUser)
    {
        $isUpdated = DB::transaction(function () use(&$request, &$adminUser) {

            $attrs = [
                'name' => $request->name, 
                'email' => $request->email, 
                'login_id' => strtolower(replace_space_with_dash($request->name)),
                'status' => $request->status
            ];

            if ( $request->password ) {
                $attrs = $attrs + ['password' => bcrypt($request->password)];
            }

            try {                
               $adminUser->update($attrs);
               $adminUser->roles()->sync( array($request->sub_role?? $request->role) );
               return true;
            } catch (\Throwable $th) {
                //throw $th;
                // return $th->getMessage();
                return false;
            }            

        });
        if ( $isUpdated === true ) {
            return back()->with('success', 'Successfully Updated.');
        }
        return back()->with('error', 'Error when editting an office user.');
        
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back();
    }
}
