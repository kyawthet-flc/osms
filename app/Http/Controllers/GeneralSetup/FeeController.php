<?php

namespace App\Http\Controllers\GeneralSetup;

use App\Http\Controllers\Controller;
use App\Model\GeneralSetup\{ Fee, ApplicationModule };
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FeeController extends Controller
{
    protected $basePath = 'enforcements.general-setups.fees.';
    
    public function index()
    {
        $this->data = array(
            'lists' => Fee::get(['*'])->groupBy('application_module_id'),
            'applicationModules' => ApplicationModule::pluck('name', 'id')->toArray()
        );
        return $this->viewPath('index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Fee $fee)
    {
        //
    }
  
    public function edit(Fee $fee)
    {
        //
    }

    public function update(Request $request, Fee $fee)
    {
        $fee->update([
            "application_module_id" => $request->application_module_id,
            "type" => $request->type,
            "name" => $request->name,
            "code" => \Str::of($request->name)->slug('-'),
            "amount" => $request->amount,
            "currency" => $request->currency
        ]);
        return back()->with('success', 'Successfully Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\GeneralSetup\Fee  $fee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fee $fee)
    {
        //
    }
}
