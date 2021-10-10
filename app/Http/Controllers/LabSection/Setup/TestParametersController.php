<?php

namespace App\Http\Controllers\LabSection\Setup;

use App\Http\Controllers\Controller;
use App\Model\LabSection\TestParameters;
use Illuminate\Http\Request;

class TestParametersController extends Controller
{
    protected $basePath = 'lab-sections.setups.test_parameters.';
    protected $redirect = 'lab_section.setup.test_parameters.index';
    
    public function index()
    {
        $this->data = [
            'types' => array_diff(getParametersType(),['Microbial Limit Test']) + ['clear' => 'Reset'],
            'lists' => TestParameters::Type(request('f_name',''))->paginate(25),
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
            'types' => array_diff(getParametersType(),['Microbial Limit Test']),
            'data' => new TestParameters(),
            'route' => route('lab_section.setup.test_parameters.store'),
            'method' => 'post',
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
        $origin = $request->name;
        $request['name'] = strip_tags($request->name);
        $request->validate([
            'name' => 'required',
            'type' => 'required',
        ]);
        $store = TestParameters::create(['name' => $origin, 'type' => $request->type]);
        if($store) {
            return redirect(route($this->redirect))->with('success', 'Successfully Saved');
        }else {
            return redirect(route($this->redirect))->with('error', 'Something went wrong');
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
        $this->data = [
            'types' => array_diff(getParametersType(),['Microbial Limit Test']),
            'data' => TestParameters::find($id),
            'route' => route('lab_section.setup.test_parameters.update', ['test_parameter' => $id]),
            'method' => 'put',
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
        $origin = $request->name;
        $request['name'] = strip_tags($request->name);
        $request->validate([
            'name' => 'required',
            'type' => 'required',
        ]);

        $store = TestParameters::find($id)->update(['name' => $origin , 'type' => $request->type]);
        if($store) {
            return redirect(route($this->redirect))->with('success', 'Successfully updated');
        }else {
            return redirect(route($this->redirect))->with('error', 'Something went wrong');
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
        $delete = TestParameters::find($id)->delete();
        if($delete) {
            return redirect(route($this->redirect))->with('success', 'Successfully deleted');
        }else {
            return redirect(route($this->redirect))->with('error', 'Something went wrong');
        }
    }
}
