<?php

namespace App\Http\Controllers\GeneralSetup;

use App\Http\Controllers\Controller;
use App\Model\GeneralSetup\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    protected $basePath = 'enforcements.general-setups.countries.';
    
    public function index()
    {
        $this->data = array(
            'lists' => Country::get(['*'])
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
            'country' => new Country
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
        Country::create($request->validate([
            'name' => 'required',
            'name_mm' => 'nullable',
            'code' => 'required'
        ]));
        return redirect()->route('general_setup.countries.index')->with('success', 'Successfully Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\GeneralSetup\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\GeneralSetup\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\GeneralSetup\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        $country->update($request->validate([
            'name' => 'required',
            'name_mm' => 'nullable',
            'code' => 'required'
        ]));
        return back()->with('success', 'Successfully Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\GeneralSetup\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        //
    }
}
