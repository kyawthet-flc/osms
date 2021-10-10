<?php

namespace App\Http\Controllers\ProductSetup;

use App\Http\Controllers\Controller;
use App\Model\ProductSetup\TypeOfProcedure;
use App\Model\ProductSetup\TypeOfProcedureStatus;
use Illuminate\Http\Request;

class TypeOfProcedureStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $basePath = "enforcements.product_setups.type_of_procedure_status.";
    public function index()
    {
        $result = TypeOfProcedureStatus::orderByDesc('id')->paginate(20);
        return view($this->basePath.'index', compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proc_type = [];
        foreach(TypeOfProcedure::all() as $tp) {
            $proc_type[$tp->id] = $tp->name;
        }
        $product_type = ['1' => 'Product A', '2' => 'Product B'];
        $product = new TypeOfProcedureStatus();
        return view($this->basePath.'create', compact('proc_type','product','product_type'));
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
            'proc_type_id' => 'required',
            'product_type_id' => 'required',
            'status' => 'required',
        ]);

        TypeOfProcedureStatus::create([
            'code' => $request->code,
            'name' => $request->name,
            'description' => $request->desc,
            'proc_type_id' => $request->proc_type_id,
            'product_type_id' => $request->product_type_id,
            'status' => $request->status,
            'user_id' => Auth()->user()->id
        ]);

        return redirect(route('product_setup.type_of_procedure_status.index'))->with('success', 'Successfully created');
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
        $proc_type = [];
        foreach(TypeOfProcedure::all() as $tp) {
            $proc_type[$tp->id] = $tp->name;
        }
        $product_type = ['1' => 'Product A', '2' => 'Product B'];
        $product = TypeOfProcedureStatus::find($id);
        return view($this->basePath.'edit', compact('product','proc_type','product_type'));
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
            'proc_type_id' => 'required',
            'product_type_id' => 'required',
            'status' => 'required',
        ]);

        $cp = TypeOfProcedureStatus::find($id);
        $cp->update([
            'code' => $request->code,
            'name' => $request->name,
            'description' => $request->desc,
            'proc_type_id' => $request->proc_type_id,
            'product_type_id' => $request->product_type_id,
            'status' => $request->status,
            'user_id' => Auth()->user()->id
        ]);

        return redirect(route('product_setup.type_of_procedure_status.index'))->with('success', 'Successfully Saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cp = TypeOfProcedureStatus::find($id);
        $cp->delete();

        return redirect()->back()->with('success', 'Successfully deleted');
    }
}
