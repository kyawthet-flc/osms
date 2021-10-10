<?php

namespace App\Http\Controllers\LabSection\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\LabSection\LabParameter;
use App\Model\ProductSetup\RouteOfAdministration;
use App\Model\ProductSetup\DosageForm;

class ParameterController extends Controller
{
    protected $basePath = 'lab-sections.setups.';

    public function index(Request $request)
    {
        $this->data = array(
            'lists' => LabParameter::paginate(25)
        );
        return $this->viewPath('index');
    }

    /* public function show(Request $request)
    {
    } */

    public function create(Request $request)
    {
        $this->data = array(
            'types' => [], 'labParameter' => new LabParameter
        );
        return $this->viewPath('create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required', 'type_id' => 'required', 'name' => 'required'
        ]);

        if ( LabParameter::create($validated) ) {
            return back()->with('success', 'Successfully saved Lab Parameter!');
        }

        return back()->with('error', 'Error in saving Lab Parameter!');
    }

    public function edit(Request $request,LabParameter $labParameter)
    {
        $this->data = array(
            'types' => [], 'labParameter' => $labParameter
        );
        return $this->viewPath('edit');
    }

    public function update(Request $request,LabParameter $labParameter)
    {
        $validated = $request->validate([
            'type' => 'required', 'type_id' => 'required', 'name' => 'required'
        ]);

        if ( $labParameter->update($validated) ) {
            return back()->with('success', 'Successfully updated Lab Parameter!');
        }

        return back()->with('error', 'Error in updating Lab Parameter!');
    }

    public function getSubTypeByType(Request $request)
    {
        // 'dosageForms' => DosageForm::get(),
        // 'routeOfAdministrations' => RouteOfAdministration::get(),
        $list = array();

        if( $request->type === 'DF') {
            $list = DosageForm::pluck('name', 'id');   
        } else if( $request->type === 'ROA') {
            $list = RouteOfAdministration::pluck('name', 'id');            
        } else if( $request->type === 'MPT') {
            // $list = DosageForm::get();            
        }

        return $this->jsonResponse('success', 'Successfully Fetched.', '#', array(
            'list' => $list
        ));
    }

}