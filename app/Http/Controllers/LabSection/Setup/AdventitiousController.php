<?php

namespace App\Http\Controllers\LabSection\Setup;

use App\Http\Controllers\Controller;
use App\Model\LabSection\Microbial;
use App\Model\LabSection\AdventitiousBacteria;
use Illuminate\Http\Request;

class  AdventitiousController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $basePath = 'lab-sections.setups.adventitious.';

    protected $indexTypes = ['Medium and Incubation Temperature', 'Test Organisms', 'Growth Presence/ Absence'];

    public function index()
    {
        $this->data = [
            'lists' => AdventitiousBacteria::paginate(20),
        ]; 
        return $this->viewPath('index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data = [
            'data' => new AdventitiousBacteria(),
            'route' => route('lab_section.setup.adventitious.store'),
            'method' => 'post',
            'indexTypes' => $this->indexTypes
        ];
        return $this->viewPath('_form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $request->validate(['index' => 'required', 'value' => 'required']);
        $store = AdventitiousBacteria::create(['index' => $request->index, 'value' => $request->value]);
        if($store) {
            return redirect(route('lab_section.setup.adventitious.index'))->with('success', 'Successfully saved');
        }else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
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
        $data = AdventitiousBacteria::find($id);
        $this->data = [
            'data' => $data,
            'route' => route('lab_section.setup.adventitious.update', ['adventitiou' => $id]),
            'method' => 'put',
            'showSub' => true,
            'indexTypes' => $this->indexTypes,
            'lists' => $data->subItem
        ];
        return $this->viewPath('_form');
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
        $request->validate(['index' => 'required', 'value' => 'required']);
        $store = AdventitiousBacteria::find($id)->update(['index' => $request->index, 'value' => $request->value]);
        if($store) {
            return redirect(route('lab_section.setup.adventitious.index'))->with('success', 'Success! Please insert sub microbial item');
        }else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = AdventitiousBacteria::find($id)->delete();
        if($delete) {
            return redirect()->back()->with('success', 'Successfully deleted');
        }else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
