<?php

namespace App\Http\Controllers\GeneralSetup;

use App\Http\Controllers\Controller;
use App\Model\GeneralSetup\{
    Division,
    District
};
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    protected $basePath = 'enforcements.general-setups.districts.';
    
    public function index()
    {
        $this->data = array(
            'divisions' => Division::pluck('name', 'id')->toArray(),
            'lists' => District::orderBy('division_id', 'desc')->paginate(25)
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
            'divisions' => Division::pluck('name', 'id')->toArray(),
            'district' => new District
        );
        return $this->viewPath('create');
    }

    public function store(Request $request)
    {
        District::create($request->validate([
            'division_id' => 'required',
            'name' => 'required',
            'name_mm' => 'nullable'
        ]));
        return redirect()->route('general_setup.districts.index')->with('success', 'Successfully Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\GeneralSetup\District  $district
     * @return \Illuminate\Http\Response
     */
    public function show(District $district)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\GeneralSetup\District  $district
     * @return \Illuminate\Http\Response
     */
    public function edit(District $district)
    {
        //
    }

   
    public function update(Request $request, District $district)
    {
        $district->update($request->validate([
            'division_id' => 'required',
            'name' => 'required',
            'name_mm' => 'nullable'
        ]));
        return redirect()->route('general_setup.districts.index')->with('success', 'Successfully Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\GeneralSetup\District  $district
     * @return \Illuminate\Http\Response
     */
    public function destroy(District $district)
    {
        //
    }
}
