<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

use App\Model\Task\Diac\DiacApplication;
use App\Model\Task\Drc\DrcApplication;
use App\Model\Task\Dlmc\DlmcApplication;
use App\Model\Task\Onetime\OnetimeApplication;

use App\Http\Requests\{ ChangePasswordRequest, UpdateProfileRequest }; 

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware('auth', ['except' => ['redirectToLogin']]);
    }

    public function redirectToLogin()
    {
        return redirect()->route('login');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return $this->toView('home');
    }

    public function changePassword()
    {
        return view('auth.change-password',['user' => auth()->user() ]);
    }

    public function storeChangedPassword(ChangePasswordRequest $request)
    {
        $isChanged = DB::transaction(function () use (&$request) {
            return auth()->user()->update(['password' => bcrypt($request->password) ]);
        });
        if ( $isChanged ) {
            return redirect()->back()->with('success', 'Password Changed.');
        }
        return redirect()->back()->with('error', 'Error to change password.');
    }
    
    public function profile()
    {
        return view('profile.view',['user' => auth()->user() ]);
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $isChanged = DB::transaction(function () use (&$request) {
            return auth()->user()->update(['display_name' => $request->display_name ]);
        });
        if ( $isChanged ) {
            return redirect()->back()->with('success', 'Profile Updated.');
        }
        return redirect()->back()->with('error', 'Error to update profile.');
    }

}
