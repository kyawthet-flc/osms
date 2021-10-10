<?php

namespace App\Http\Controllers\GeneralSetup;

use App\Http\Controllers\Controller;
use App\Model\GeneralSetup\{Period, ApplicationModule };
use Illuminate\Http\Request;

class PeriodController extends Controller
{
    protected $basePath = 'enforcements.general-setups.periods.';
    
    public function index()
    {
        $this->data = array(
            'lists' => Period::get(['*']),
            'applicationModules' => ApplicationModule::pluck('name', 'id')->toArray(),
            'applicationTypes' => config('appenv.application_type'),
            'periods' => config('appenv.periods'),
            'periodUnits' => config('appenv.period_units')
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
        $this->data = array(
            'period' => new Period,
            'applicationModules' => ApplicationModule::pluck('name', 'id')->toArray(),
            'applicationTypes' => config('appenv.application_type'),
            'periods' => config('appenv.periods'),
            'periodUnits' => config('appenv.period_units')
        );
        return $this->viewPath('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Period::create($request->validate([
            'application_module_id' => 'required',
            'sub_app_type' => 'nullable',
            'name' => 'required',
            'period' => 'required',
            'period_unit' => 'nullable',
            'remark' => 'nullable'
        ]));
        
        return redirect()->route('general_setup.periods.index')->with('success', 'Successfully Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\GeneralSetup\Period  $period
     * @return \Illuminate\Http\Response
     */
    public function show(Period $period)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\GeneralSetup\Period  $period
     * @return \Illuminate\Http\Response
     */
    public function edit(Period $period)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\GeneralSetup\Period  $period
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Period $period)
    {
        $period->update($request->validate([
            'application_module_id' => 'required',
            'sub_app_type' => 'nullable',
            'name' => 'required',
            'period' => 'required',
            'period_unit' => 'nullable',
            'remark' => 'nullable'
        ]));
        
        return redirect()->route('general_setup.periods.index')->with('success', 'Successfully Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\GeneralSetup\Period  $period
     * @return \Illuminate\Http\Response
     */
    public function destroy(Period $period)
    {
        //
    }
}
