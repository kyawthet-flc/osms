<?php

namespace App\Http\Controllers\ProductSetup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\ProductSetup\{Cause, ProductType};

class CauseController extends Controller
{
    protected $basePath = "enforcements.product_setups.causes.";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view($this->basePath.'index', [
            'result' => Cause::orderByDesc('id')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->basePath.'create', [
            'product_type_ids' => ProductType::pluck('name', 'id'), 'product' => new Cause
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
        $request->validate($this->validations());
        Cause::create($this->parameters());
        return redirect(route('product_setup.cause.index'))->with('success', 'Successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
            'product_type_ids' => ProductType::pluck('name', 'id'), 'product' => Cause::find($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate($this->validations());        
        $cp = Cause::find($id);
        $cp->update($this->parameters());
        return redirect(route('product_setup.cause.index'))->with('success', 'Successfully Saved');
    }

    public function validations()
    {
        return [
            'code' => 'required',
            'desc' => 'nullable',
            'observance' => 'nullable',
            'product_type_id' => 'required'
        ];
    }

    public function parameters()
    {
        return [
            'code' => request('code'),
            'description' => request('description'),
            'observance' => request('observance'),
            'product_type_id' => request('product_type_id'),
            'user_id' => auth()->user()->id,
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cp = Cause::find($id);
        $cp->delete();

        return redirect()->back()->with('success', 'Successfully deleted');
    }
}
