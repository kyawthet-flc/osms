<?php

namespace App\Http\Controllers\GeneralSetup;

use App\Http\Controllers\Controller;
use App\Model\ProductSetup\OnetimePurpose;
use Illuminate\Http\Request;

class OnetimePurposeController extends Controller
{
    protected $basePath = 'enforcements.general-setups.onetime-purposes.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data = array(
            'lists' => OnetimePurpose::orderBy('id', 'desc')->paginate(25)
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
            'onetimePurpose' => new OnetimePurpose
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
        OnetimePurpose::create($request->validate([
            'name' => 'required',
            'description' => 'required',
        ]));
        return redirect()->route('general_setup.onetimePurposes.index')->with('success', 'Successfully Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\GeneralSetup\OnetimePurpose  $onetimePurpose
     * @return \Illuminate\Http\Response
     */
    public function show(OnetimePurpose $onetimePurpose)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\GeneralSetup\Township  $township
     * @return \Illuminate\Http\Response
     */
    public function edit(OnetimePurpose $onetimePurpose)
    {
        $this->data = array(
            'onetimePurpose' => $onetimePurpose
        );
        return $this->viewPath('edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\GeneralSetup\Township  $township
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OnetimePurpose $onetimePurpose)
    {
        $onetimePurpose->update($request->validate([
            'name' => 'required',
            'description' => 'required',
        ]));
        return redirect()->route('general_setup.onetimePurposes.index')->with('success', 'Successfully Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\GeneralSetup\Township  $township
     * @return \Illuminate\Http\Response
     */
    public function destroy(OnetimePurpose $onetimePurpose)
    {
        $onetimePurpose->delete();
        return redirect()->route('general_setup.onetimePurposes.index')->with('success', 'Successfully Deleted.');

    }
}
