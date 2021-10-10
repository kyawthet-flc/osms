<?php

namespace App\Http\Controllers\ProductSetup;

use App\Http\Controllers\Controller;
use App\Model\ProductSetup\TypeOfAuthorization;
use Illuminate\Http\Request;

class TypeOfAuthorizationController extends Controller
{
    protected $basePath = "enforcements.product_setups.type_of_authorization.";
    public function index()
    {
        $result = TypeOfAuthorization::orderByDesc('id')->paginate(20);
        return view($this->basePath.'index', compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product_type_ids = [ '1' => 'A', '1' => 'B'];
        $product = new TypeOfAuthorization();
        return view($this->basePath.'create', compact( 'product_type_ids','product'));
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
            'product_type_id' => 'required',
            'status' => 'required',

        ]);
        TypeOfAuthorization::create([
            'code' => $request->code,
            'name' => $request->name,
            'description' => $request->desc,
            'product_type_id' => $request->product_type_id,
            'status' => $request->status,
            'user_id' => Auth()->user()->id
        ]);

        return redirect(route('product_setup.type_of_authorization.index'))->with('success', 'Successfully created');
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
        $product_type_ids = [ '1' => 'A', '1' => 'B'];
        $product = TypeOfAuthorization::find($id);
        return view($this->basePath.'edit', compact('product','product_type_ids'));
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
        $cp = TypeOfAuthorization::find($id);
        $cp->update([
            'name' => $request->name,
            'description' => $request->desc,'code' => $request->code,
            'name' => $request->name,
            'description' => $request->desc,
            'product_type_id' => $request->product_type_id,
            'status' => $request->status,
            'user_id' => Auth()->user()->id
        ]);

        return redirect(route('product_setup.type_of_authorization.index'))->with('success', 'Successfully Saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cp = TypeOfAuthorization::find($id);
        $cp->delete();

        return redirect()->back()->with('success', 'Successfully deleted');
    }
}
