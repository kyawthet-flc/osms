<?php

namespace App\Http\Controllers\LabSection\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\LabSection\ReferenceValue;
use App\Model\LabSection\ReferenceMethod;
use App\Model\LabSection\Biostandardization;

class BiostandardizationController extends Controller
{
    protected $basePath = 'lab-sections.setups.biostandardization.';
    protected $redirect = 'lab_section.setup.biostandardization.index';
    public function index()
    {
        $this->data = [
            'lists' => Biostandardization::paginate(25),
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
            'data' => new Biostandardization(),
            'ref_method' => ReferenceMethod::pluck('name')->toArray(),
            'ref_value' => ReferenceValue::pluck('name')->toArray(),
            'route' => route('lab_section.setup.biostandardization.store'),
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
        $request->validate([
            'name' => 'required',
            'reference_value' => 'required',
            'reference_method' => 'required'
        ]);
        $data = $request->only(['name','reference_value','reference_method']);
        $store = Biostandardization::create($data);
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
            'data' => Biostandardization::find($id),
            'ref_method' => ReferenceMethod::pluck('name')->toArray(),
            'ref_value' => ReferenceValue::pluck('name')->toArray(),
            'route' => route('lab_section.setup.biostandardization.update', ['biostandardization' => $id]),
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
        $data = $request->only(['name','reference_value','reference_method']);
        $store = Biostandardization::find($id)->update($data);
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
        $delete = Biostandardization::find($id)->delete();
        if($delete) {
            return redirect(route($this->redirect))->with('success', 'Successfully deleted');
        }else {
            return redirect(route($this->redirect))->with('error', 'Something went wrong');
        }
    }
}
