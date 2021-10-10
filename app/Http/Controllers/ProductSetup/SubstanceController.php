<?php

namespace App\Http\Controllers\ProductSetup;

use App\Http\Controllers\Controller;
use App\Model\ProductSetup\Substance;
use Illuminate\Http\Request;

class SubstanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $basePath = "enforcements.product_setups.substance.";
    public function index()
    {
        $result = Substance::orderByDesc('id')->get();
        return view($this->basePath.'index', compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $req_status = ['active' => 'Active', 'inactive' => 'Inactive'];
        $admitted_status = ['active' => 'Active', 'inactive' => 'Inactive'];
        $product_type = [ 1 => 'Pro A', 2 => 'Pro B'];
        $product = new Substance();
        return view($this->basePath.'create', compact('req_status','product','admitted_status','product_type'));
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
            'req_ba_be_status' => 'required',
            'admitted_status' => 'required',
            'cas_no' => 'required',
            'source_name' => 'required',
            'reason' => 'required',
            'product_type_id' => 'required',
            'preferred_term' => 'required',
            'controlled_sus' => 'required',
            'status' => 'required'
        ]);

        Substance::create([
            'name' => $request->name,
            'req_ba_be_status' => $request->req_ba_be_status,
            'admitted_status' => $request->admitted_status,
            'cas_no' => $request->cas_no,
            'source_name' => $request->source_name,
            'reason' => $request->reason,
            'product_type_id' => $request->product_type_id,
            'preferred_term' => $request->preferred_term,
            'controlled_sus' => $request->controlled_sus,
            'status' => $request->status,
            'user_id' => Auth()->user()->id,
        ]);

        return redirect(route('product_setup.substance.index'))->with('success', 'Successfully created');
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
        $req_status = ['active' => 'Active', 'inactive' => 'Inactive'];
        $admitted_status = ['active' => 'Active', 'inactive' => 'Inactive'];
        $product_type = [ 1 => 'Pro A', 2 => 'Pro B'];
        $product = Substance::find($id);
        return view($this->basePath.'edit', compact('product','req_status','product_type','admitted_status'));
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
            'req_ba_be_status' => 'required',
            'admitted_status' => 'required',
            'cas_no' => 'required',
            'source_name' => 'required',
            'reason' => 'required',
            'product_type_id' => 'required',
            'preferred_term' => 'required',
            'controlled_sus' => 'required',
            'status' => 'required'
        ]);

        $cp = Substance::find($id);
        $cp->update([
            'name' => $request->name,
            'req_ba_be_status' => $request->req_ba_be_status,
            'admitted_status' => $request->admitted_status,
            'cas_no' => $request->cas_no,
            'source_name' => $request->source_name,
            'reason' => $request->reason,
            'product_type_id' => $request->product_type_id,
            'preferred_term' => $request->preferred_term,
            'controlled_sus' => $request->controlled_sus,
            'status' => $request->status,
            'user_id' => Auth()->user()->id,
        ]);

        return redirect(route('product_setup.substance.index'))->with('success', 'Successfully Saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cp = Substance::find($id);
        $cp->delete();

        return redirect()->back()->with('success', 'Successfully deleted');
    }
}
