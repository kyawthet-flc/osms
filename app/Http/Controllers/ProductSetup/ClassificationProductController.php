<?php

namespace App\Http\Controllers\ProductSetup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\ProductSetup\ClassificationOfProdcut;

class ClassificationProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $basePath = "enforcements.product_setups.classification_of_product.";
    public function index()
    {
        $result = ClassificationOfProdcut::orderByDesc('id')->get();
        return view($this->basePath.'index', compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $level = ['1' => 'A', '2' => 'B'];
        $parent = [ 'A' => 'A', 'B' => 'B'];
        $product = new ClassificationOfProdcut();
        return view($this->basePath.'create', compact('level', 'parent','product'));
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
            'level' => 'required',
            'desc' => 'required',
            'observance' => 'required',
            'parent' => 'required',
        ]);
        ClassificationOfProdcut::create([
            'code' => $request->code,
            'level' => $request->level,
            'description' => $request->desc,
            'observance' => $request->observance,
            'user_id' => Auth()->user()->id,
            'parent' => $request->parent
        ]);

        return redirect(route('product_setup.classification_product.index'))->with('success', 'Successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd($id,$id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $level = ['1' => 'A', '2' => 'B'];
        $parent = [ 'A' => 'A', 'B' => 'B'];
        $product = ClassificationOfProdcut::find($id);
        return view($this->basePath.'edit', compact('product','level','parent'));
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
            'level' => 'required',
            'desc' => 'required',
            'observance' => 'required',
            'parent' => 'required',
        ]);
        $cp = ClassificationOfProdcut::find($id);
        $cp->update([
            'code' => $request->code,
            'level' => $request->level,
            'description' => $request->desc,
            'observance' => $request->observance,
            'parent' => $request->parent
        ]);

        return redirect(route('product_setup.classification_product.index'))->with('success', 'Successfully Saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cp = ClassificationOfProdcut::find($id);
        $cp->delete();

        return redirect()->back()->with('success', 'Successfully deleted');
    }
}
