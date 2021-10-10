<?php

namespace App\Http\Controllers\GeneralSetup;

use App\Http\Controllers\Controller;
use App\Model\GeneralSetup\ApplicationModule;
use Illuminate\Http\Request;

class ApplicationModuleController extends Controller
{
    protected $basePath = 'enforcements.general-setups.application-modules.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data = array(
            'lists' => ApplicationModule::get(['*'])
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\GeneralSetup\ApplicationModule  $applicationModule
     * @return \Illuminate\Http\Response
     */
    public function show(ApplicationModule $applicationModule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\GeneralSetup\ApplicationModule  $applicationModule
     * @return \Illuminate\Http\Response
     */
    public function edit(ApplicationModule $applicationModule)
    {
        $this->data = array(
            'list' => $applicationModule
        );
        return $this->viewPath('edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\GeneralSetup\ApplicationModule  $applicationModule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ApplicationModule $applicationModule)
    {
        $applicationModule->update(['name' => $request->name ]);
        return redirect()->route('general_setup.applicationModules.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\GeneralSetup\ApplicationModule  $applicationModule
     * @return \Illuminate\Http\Response
     */
    public function destroy(ApplicationModule $applicationModule)
    {
        //
    }
}
