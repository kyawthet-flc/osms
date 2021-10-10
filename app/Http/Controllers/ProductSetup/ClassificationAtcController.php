<?php

namespace App\Http\Controllers\ProductSetup;

use App\Http\Controllers\Controller;
use App\Model\ProductSetup\ClassificationAtc;
use Illuminate\Http\Request;

class ClassificationAtcController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $basePath = "enforcements.product_setups.classification_atc.";
    public function index()
    {
        $result = ClassificationAtc::orderByDesc('id')->get();
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
        $product = new ClassificationAtc();
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
            'parent' => 'required'
        ]);
        ClassificationAtc::create([
            'code' => $request->code,
            'level' => $request->level,
            'description' => $request->desc,
            'observance' => $request->observance,
            'user_id' => Auth()->user()->id,
            'parent' => $request->parent
        ]);

        return redirect(route('product_setup.classification_atc.index'))->with('success', 'Successfully created');
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
        $level = ['1' => 'A', '2' => 'B'];
        $parent = [ 'A' => 'A', 'B' => 'B'];
        $product = ClassificationAtc::find($id);
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
            'parent' => 'required'
        ]);

        $cp = ClassificationAtc::find($id);
        $cp->update([
            'code' => $request->code,
            'level' => $request->level,
            'description' => $request->desc,
            'observance' => $request->observance,
            'parent' => $request->parent
        ]);

        return redirect(route('product_setup.classification_atc.index'))->with('success', 'Successfully Saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cp = ClassificationAtc::find($id);
        $cp->delete();

        return redirect()->back()->with('success', 'Successfully deleted');
    }
}
