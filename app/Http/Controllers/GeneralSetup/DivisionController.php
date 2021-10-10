<?php

namespace App\Http\Controllers\GeneralSetup;

use App\Http\Controllers\Controller;
use App\Model\GeneralSetup\{Division, Country};
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    protected $basePath = 'enforcements.general-setups.divisions.';
    
    public function index()
    {
        $this->data = array(
            'countries' => Country::pluck('name', 'id')->toArray(),
            'lists' => Division::get(['*'])
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
            'countries' => Country::pluck('name', 'id')->toArray(),
            'division' => new Division
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
        Division::create($request->validate([
            'country_id' => 'required',
            'name' => 'required',
            'name_mm' => 'nullable',
            'type' => 'required'
        ]));
        return redirect()->route('general_setup.divisions.index')->with('success', 'Successfully Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\GeneralSetup\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function show(Division $division)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\GeneralSetup\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function edit(Division $division)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\GeneralSetup\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Division $division)
    {
        $division->update($request->validate([
            'country_id' => 'required',
            'name' => 'required',
            'name_mm' => 'nullable',
            'type' => 'required'
        ]));
        return redirect()->route('general_setup.divisions.index')->with('success', 'Successfully Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\GeneralSetup\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function destroy(Division $division)
    {
        //
    }
}
