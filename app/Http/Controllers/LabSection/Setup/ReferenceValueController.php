<?php

namespace App\Http\Controllers\LabSection\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\LabSection\ReferenceValue;

class ReferenceValueController extends Controller
{
    protected $basePath = 'lab-sections.setups.reference_value.';
    
    public function index()
    {
        $this->data = ['lists' => ReferenceValue::paginate(25)];
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
            'types' => getParametersType(),
            'data' => new ReferenceValue(),
            'method' => 'post',
            'route' => route('lab_section.setup.reference_value.store')
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
        $request->validate(['name' => 'required', 'type' => 'required']);
        $data = $request->only(['name', 'type']);
        $save = ReferenceValue::create($data);
        if($save) {
            return redirect(route('lab_section.setup.reference_value.index'))->with('success','Successfully Saved');

        }
        return redirect(route('lab_section.setup.reference_value.index'))->with('error','Something went wrong!');
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
        $this->data = [
            'types' => getParametersType(),
            'data' => ReferenceValue::find($id),
            'route' => route('lab_section.setup.reference_value.update',['reference_value' => $id]),
            'method' => 'put'
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
        $request->validate(['name' => 'required', 'type' => 'required']);
        $data = $request->only(['name', 'type']);
        $update = ReferenceValue::find($id)->update($data);
        if($update) {
            return redirect(route('lab_section.setup.reference_value.index'))->with('success', 'Successsfully updated');
        }else {
            return redirect(route('lab_section.setup.reference_value.index'))->with('error', 'Something went wrong');
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
        $delete = ReferenceValue::find($id)->delete();
        if($delete) {
            return redirect()->back()->with('success', 'Successfully deleted');
        }else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
