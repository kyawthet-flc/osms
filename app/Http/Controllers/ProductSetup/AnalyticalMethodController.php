<?php

namespace App\Http\Controllers\ProductSetup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\ProductSetup\{
    AnalyticalMethod,
    ProductType
};

class AnalyticalMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $basePath = "enforcements.product_setups.analytical_method.";
    public function index()
    {
        $result = AnalyticalMethod::orderByDesc('id')->get();
        return view($this->basePath.'index', compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->basePath.'create', [
            'ref_analysis_ids' => ['1' => 'A', '2' => 'B'], 
            'product_type_ids' => ProductType::pluck('name', 'id'),
            'product' =>  new AnalyticalMethod()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'desc' => 'required',
            'observance' => 'nullable',
            'ref_analysis_id' => 'required',
            'product_type_id' => 'required'
        ]);

        AnalyticalMethod::create([
            'name' => $request->name,
            'description' => $request->desc,
            'observance' => $request->observance,
            'ref_analysis_id' => $request->ref_analysis_id,
            'product_type_id' => $request->product_type_id,
            'user_id' => Auth()->user()->id,
        ]);

        return redirect(route('product_setup.analytical_method.index'))->with('success', 'Successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view($this->basePath.'edit', [
            'ref_analysis_ids' => ['1' => 'A', '2' => 'B'], 
            'product_type_ids' => ProductType::pluck('name', 'id'),
            'product' => AnalyticalMethod::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'desc' => 'required',
            'observance' => 'nullable',
            'ref_analysis_id' => 'required',
            'product_type_id' => 'required'
        ]);
        
        $cp = AnalyticalMethod::find($id);
        $cp->update([
            'name' => $request->name,
            'description' => $request->desc,
            'observance' => $request->observance,
            'ref_analysis_id' => $request->ref_analysis_id,
            'product_type_id' => $request->product_type_id,
            'user_id' => Auth()->user()->id,
        ]);

        return redirect(route('product_setup.analytical_method.index'))->with('success', 'Successfully Saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cp = AnalyticalMethod::find($id);
        $cp->delete();

        return redirect()->back()->with('success', 'Successfully deleted');
    }
}
