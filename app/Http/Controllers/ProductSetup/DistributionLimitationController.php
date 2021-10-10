<?php

namespace App\Http\Controllers\ProductSetup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\ProductSetup\DistributionLimitation;

class DistributionLimitationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $basePath = "enforcements.product_setups.distribution_limitation.";
    public function index()
    {
        $result = DistributionLimitation::orderByDesc('id')->get();
        return view($this->basePath.'index', compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product_type_ids = ['1' => 'A', '2' => 'B'];
        $product = new DistributionLimitation();
        return view($this->basePath.'create', compact('product_type_ids','product'));
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
            'code' => 'required',
            'name' => 'required',
            'desc' => 'required',
            'observance' => 'required',
            'product_type_id' => 'required',
            'dl_status' => 'required',
        ]);

        DistributionLimitation::create([
            'code' => $request->code,
            'name' => $request->name,
            'description' => $request->desc,
            'observance' => $request->observance,
            'product_type_id' => $request->product_type_id,
            'dl_status' => $request->dl_status,
            'user_id' => Auth()->user()->id,
        ]);

        return redirect(route('product_setup.distribution_limitation.index'))->with('success', 'Successfully created');
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
        $product_type_ids = ['1' => 'A', '2' => 'B'];
        $product = DistributionLimitation::find($id);
        return view($this->basePath.'edit', compact('product','product_type_ids',));
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
            'code' => 'required',
            'name' => 'required',
            'desc' => 'required',
            'observance' => 'required',
            'product_type_id' => 'required',
            'dl_status' => 'required',
        ]);

        $cp = DistributionLimitation::find($id);
        $cp->update([
            'code' => $request->code,
            'name' => $request->name,
            'description' => $request->desc,
            'observance' => $request->observance,
            'product_type_id' => $request->product_type_id,
            'dl_status' => $request->dl_status,
            'user_id' => Auth()->user()->id,
        ]);

        return redirect(route('product_setup.distribution_limitation.index'))->with('success', 'Successfully Saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cp = DistributionLimitation::find($id);
        $cp->delete();

        return redirect()->back()->with('success', 'Successfully deleted');
    }
}
