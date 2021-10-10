<?php

namespace App\Http\Controllers\ProductSetup;

use App\Http\Controllers\Controller;
use App\Model\ProductSetup\TypeOfProcedure;
use Illuminate\Http\Request;

class TypeOfProcedureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $basePath = "enforcements.product_setups.type_of_procedure.";
    public function index()
    {
        $result = TypeOfProcedure::orderByDesc('id')->paginate(20);
        return view($this->basePath.'index', compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ref_analysis_ids = ['1' => 'A', '2' => 'B'];
        $product_type_ids = [ '1' => 'A', '1' => 'B'];
        $product = new TypeOfProcedure();
        return view($this->basePath.'create', compact('ref_analysis_ids', 'product_type_ids','product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required', 'desc' => 'required']);
        TypeOfProcedure::create([
            'name' => $request->name,
            'description' => $request->desc,
        ]);

        return redirect(route('product_setup.type_of_procedure.index'))->with('success', 'Successfully created');
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
        $ref_analysis_ids = ['1' => 'A', '2' => 'B'];
        $product_type_ids = [ '1' => 'A', '1' => 'B'];
        $product = TypeOfProcedure::find($id);
        return view($this->basePath.'edit', compact('product','ref_analysis_ids','product_type_ids'));
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
        $request->validate(['name' => 'required', 'desc' => 'required']);
        $cp = TypeOfProcedure::find($id);
        $cp->update([
            'name' => $request->name,
            'description' => $request->desc,
        ]);

        return redirect(route('product_setup.type_of_procedure.index'))->with('success', 'Successfully Saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cp = TypeOfProcedure::find($id);
        $cp->delete();

        return redirect()->back()->with('success', 'Successfully deleted');
    }
}
