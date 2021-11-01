<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Model\Contact;
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
        return view('auth.change_password',['user' => auth()->user() ]);
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
            return back()->with('success', 'Profile Updated.');
        }
        return back()->with('error', 'Error to update profile.');
    }

    public function contact()
    {
        if( request()->ajax() ) {
            return $this->jsonResponse('success', 'Contact Form Fetched.', url()->previous(),[
                'template' =>  view('contact._form',['user' => auth()->user() ])->render()
            ]);
        }
        return view('contact.index',['user' => auth()->user() ]);
    }

    public function saveContact(\App\Http\Requests\ContactRequest $request)
    {
        if ( Contact::create([
            'user_id' => auth()->user()->id,
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'subject' => $request->subject,
            'body' => $request->body,
            'priority_level' => $request->priority_level,
        ]) ) {
            return $this->jsonResponse('success', 'Successfully Sent.', url()->previous());
        }

        return $this->jsonResponse('error', 'Error to contact', url()->previous());

    }

}
