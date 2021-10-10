<?php

namespace App\Http\Controllers\GeneralSetup;

use App\Http\Controllers\Controller;
use App\Model\GeneralSetup\{ Division, District, Township };
use Illuminate\Http\Request;

class TownshipController extends Controller
{
    protected $basePath = 'enforcements.general-setups.townships.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data = array(
            'divisions' => Division::pluck('name', 'id')->toArray(),
            'districts' => District::pluck('name', 'id')->toArray(),
            'lists' => Township::orderBy('district_id', 'desc')->paginate(25)
        );
        return $this->viewPath('index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data = array(
            'divisions' => Division::pluck('name', 'id')->toArray(),
            'districts' => District::get(['name', 'id', 'division_id'])->toArray(),
            'township' => new Township
        );
        return $this->viewPath('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Township::create($request->validate([
            'division_id' => 'required',
            'district_id' => 'required',
            'name' => 'required',
            'name_mm' => 'nullable'
        ]));
        return redirect()->route('general_setup.townships.index')->with('success', 'Successfully Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\GeneralSetup\Township  $township
     * @return \Illuminate\Http\Response
     */
    public function show(Township $township)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\GeneralSetup\Township  $township
     * @return \Illuminate\Http\Response
     */
    public function edit(Township $township)
    {
        $this->data = array(
            'divisions' => Division::pluck('name', 'id')->toArray(),
            'districts' => District::get(['name', 'id', 'division_id'])->toArray(),
            'township' => $township
        );
        return $this->viewPath('edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\GeneralSetup\Township  $township
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Township $township)
    {
        $township->update($request->validate([
            'division_id' => 'required',
            'district_id' => 'required',
            'name' => 'required',
            'name_mm' => 'nullable'
        ]));
        return redirect()->route('general_setup.townships.index')->with('success', 'Successfully Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\GeneralSetup\Township  $township
     * @return \Illuminate\Http\Response
     */
    public function destroy(Township $township)
    {
        //
    }

    // NOt use until now
    public function ajaxSearch()
    {
        $townshipArr = array();
        if ( request('term') ) {
            $townships = Township::with(['district', 'district.division'])->where('name', 'LIKE', '%'. request('term') .'%')
            ->orWhere('name_mm', 'LIKE', '%'. request('term') .'%')->get();

            foreach ($townships as $key => $township) {
                array_push($townshipArr, [
                    'id' => $township->id, 
                    'text' => '<b>' . $township->name . ' Township</b>(<i>' . optional($township->district)->name . ' - ' . optional(optional($township->district)->division)->name . '</i>)',
                    'selected' => request('selected') == $township->id
                ]);
            }
        }
        return $this->jsonResponse('success', 'NO MSG', '#', $townshipArr);
    }
    
}
