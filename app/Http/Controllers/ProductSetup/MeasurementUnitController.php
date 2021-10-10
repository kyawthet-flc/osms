<?php

namespace App\Http\Controllers\ProductSetup;

use App\Http\Controllers\Controller;
use App\Model\ProductSetup\MeasurementUnit;
use Illuminate\Http\Request;

class MeasurementUnitController extends Controller
{
    /**
     * @authr nyan
     * @date 9/7/21
     */
    protected $basePath = "enforcements.product_setups.measurement_units.";
    public function index()
    {
        $units = MeasurementUnit::orderByDesc('id')->get();
        return view($this->basePath."index", compact('units'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'desc' => 'required'
        ]);

        $unit = $request->id ? MeasurementUnit::find($request->id) : new MeasurementUnit();
        $unit->name = $request->name;
        $unit->description = $request->desc;
        $unit->user_id = Auth()->user()->id;
        $unit->save();

        return redirect()->back()->with('success','Successfully saved');
    }

    public function ajaxGetMeasurementUnit(Request $request)
    {
        $data = [];
        $id = $request->id;
        $unit = MeasurementUnit::find($id);
        if($unit) {
            $data = ['id' => $unit->id, 'name' => $unit->name, 'desc' => $unit->description ];
        }

        return response()->json(['data' => $data]);
    }

    public function delete($id)
    {
        $unit = MeasurementUnit::find($id);
        $unit->delete();

        return redirect()->back()->with('success', 'Successfully deleted');
    }

}
