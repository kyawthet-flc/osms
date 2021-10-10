<?php

namespace App\Http\Controllers\LabSection\Setup;

use App\Http\Controllers\Controller;
use App\Model\LabSection\Microbial;
use Illuminate\Http\Request;

class MicrobialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $basePath = 'lab-sections.setups.microbial.';
    public function index()
    {
        $this->data = [
            'lists' => Microbial::paginate(20),
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
            'data' => new Microbial(),
            'route' => route('lab_section.setup.microbial.store'),
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
        $request->validate(['name' => 'required']);
        $store = Microbial::create([ 'name' => $request->name ]);
        if($store) {
            return redirect(route('lab_section.setup.microbial.index'))->with('success', 'Successfully saved');
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
        $data = Microbial::find($id);
        $this->data = [
            'data' => $data,
            'route' => route('lab_section.setup.microbial.update', ['microbial' => $id]),
            'method' => 'put',
            'showSub' => true,
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
        $request->validate(['name' => 'required']);
        $store = Microbial::find($id)->update([ 'name' => $request->name ]);
        if($store) {
            return redirect(route('lab_section.setup.microbial.index'))->with('success', 'Success! Please insert sub microbial item');
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
        $delete = Microbial::find($id)->delete();
        if($delete) {
            return redirect()->back()->with('success', 'Successfully deleted');
        }else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
