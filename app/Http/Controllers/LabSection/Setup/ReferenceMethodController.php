<?php

namespace App\Http\Controllers\LabSection\Setup;

use App\Http\Controllers\Controller;
use App\Model\LabSection\ReferenceMethod;
use Illuminate\Http\Request;

class ReferenceMethodController extends Controller
{
    protected $basePath = 'lab-sections.setups.reference_method.';
    public function index()
    {
        $this->data = ['lists' => ReferenceMethod::paginate(25)];
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
            'data' => new ReferenceMethod(),
            'method' => 'post',
            'route' => route('lab_section.setup.reference_method.store')
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
        $save = ReferenceMethod::create($data);
        if($save) {
            return redirect(route('lab_section.setup.reference_method.index'))->with('success','Successfully Saved');

        }
        return redirect(route('lab_section.setup.reference_method.index'))->with('error','Something went wrong!');
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
            'data' => ReferenceMethod::find($id),
            'route' => route('lab_section.setup.reference_method.update',['reference_method' => $id]),
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
        $update = ReferenceMethod::find($id)->update($data);
        if($update) {
            return redirect(route('lab_section.setup.reference_method.index'))->with('success', 'Successsfully updated');
        }else {
            return redirect(route('lab_section.setup.reference_method.index'))->with('error', 'Something went wrong');
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
        ReferenceMethod::find($id)->delete();
        return redirect()->back()->with('success', 'Successfully deleted');
    }
}
