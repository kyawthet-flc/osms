<?php

namespace App\Http\Controllers\ProductSetup;

use App\Http\Controllers\Controller;
use App\Model\ProductSetup\Substance as Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $basePath = "enforcements.product_setups.active_ingredient.";
    public function index()
    {
        $result = Ingredient::orderByDesc('id')->get();
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
        $product = new Ingredient();
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
        Ingredient::create([
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
        $ref_analysis_ids = ['1' => 'A', '2' => 'B'];
        $product_type_ids = [ '1' => 'A', '1' => 'B'];
        $product = Ingredient::find($id);
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
        $cp = Ingredient::find($id);
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
        $cp = Ingredient::find($id);
        $cp->delete();

        return redirect()->back()->with('success', 'Successfully deleted');
    }
}
