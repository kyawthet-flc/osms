<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

use App\Model\Task\Diac\DiacApplication;
use App\Model\Task\Drc\DrcApplication;
use App\Model\Task\Dlmc\DlmcApplication;
use App\Model\Task\Onetime\OnetimeApplication;

use App\Http\Requests\ChangePasswordRequest; 

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
        if( auth()->user()->isLabAdmin() ) {
            
            $this->data = array(
                'drc' => array(
                    'title' => 'DRC Lab',
                    'labels' => ['Check', 'Recheck', 'Result'],
                    'data' => [1, 5, 2]
                ),
                'drc_local' => array(
                    'title' => 'DRC Local Lab',
                    'labels' => ['Check', 'Recheck', 'Result'],
                    'data' => [1, 5, 2]
                )
            );
            $this->basePath = 'lab-sections.';
            return $this->viewPath('home');
            
        }

        $diacCounters = DiacApplication::where('has_extension', 'no')->select('application_type', DB::raw('count(*) as total'))
        ->groupBy('application_type')->pluck('total','application_type');
        $diacExtensionCounter = DiacApplication::where('has_extension', 'yes')->where('application_type', 'amend')->count();

        $drcCounters = DrcApplication::where('application_module_id', 2)->select('application_type', DB::raw('count(*) as total'))
        ->groupBy('application_type')->pluck('total','application_type');

        $drcLocalCounters = DrcApplication::where('application_module_id', 3)->select('application_type', DB::raw('count(*) as total'))
        ->groupBy('application_type')->pluck('total','application_type');

        $dlmcCounters = DlmcApplication::select('application_type', DB::raw('count(*) as total'))
        ->groupBy('application_type')->pluck('total','application_type');

        $onetimeCounters = OnetimeApplication::select('application_type', DB::raw('count(*) as total'))
        ->groupBy('application_type')->pluck('total','application_type');

        $this->data = array(
            'diacs' => array(
                'title' => 'DIAC',
                'labels' => ['new', 'renew', 'amend', 'extension'],
                'data' => [$diacCounters['new']?? 0, $diacCounters['renew']?? 0, $diacCounters['amend']?? 0, $diacExtensionCounter]
            ),
            'drcs' => array(
                'title' => 'DRC Import',
                'labels' => ['new', 'renew', 'amend'],
                'data' => [$drcCounters['new']?? 0, $drcCounters['renew']?? 0, $drcCounters['amend']?? 0]
            ),
            'drc_locals' => array(
                'title' => 'DRC Local',
                'labels' => ['new', 'renew', 'amend'],
                'data' => [$drcLocalCounters['new']?? 0, $drcLocalCounters['renew']?? 0, $drcLocalCounters['amend']?? 0]
            ),
            'dlmcs' => array(
                'title' => 'DLMC',
                'labels' => ['new', 'renew', 'amend'],
                'data' => [$dlmcCounters['new']?? 0, $dlmcCounters['renew']?? 0, $dlmcCounters['amend']?? 0]
            ),
            'onetimes' => array(
                'title' => 'Onetime',
                'labels' => ['new'],
                'data' => $onetimeCounters['new']?? 0
            )
        );
        return $this->viewPath('home');
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
            return redirect()->back()->with('success', 'Password successfully changed.');
        }

        return redirect()->back()->with('error', 'Error in changing password.');

    }

}
