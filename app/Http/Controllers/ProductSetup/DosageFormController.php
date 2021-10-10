<?php

namespace App\Http\Controllers\ProductSetup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\ProductSetup\DosageForm;

class DosageFormController extends Controller
{
    /**
     * @authr nyan
     * @date 13/07/2021
     */
    protected $basePath = "enforcements.product_setups.dosage_form.";
    public function index()
    {
        $result = DosageForm::orderByDesc('id')->get();
        return view($this->basePath."index", compact('result'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => isset($request->id) ? 'required' : 'required|unique:storage_conditions',
            'observance' => 'required',
            'desc' => 'required'
        ]);

        $unit = $request->id ? DosageForm::find($request->id) : new DosageForm();
        $unit->name = $request->name;
        $unit->observance = $request->observance;
        $unit->description = $request->desc;
        $unit->user_id = Auth()->user()->id;
        $unit->save();

        return redirect()->back()->with('success','Successfully saved');
    }

    public function ajaxGetData(Request $request)
    {
        $data = [];
        $id = $request->id;
        $unit = DosageForm::find($id);
        if($unit) {
            $data = ['id' => $unit->id, 'name' => $unit->name, 'observance' => $unit->observance, 'desc' => $unit->description ];
        }

        return response()->json(['data' => $data]);
    }

    public function delete($id)
    {
        $unit = DosageForm::find($id);
        $unit->delete();

        return redirect()->back()->with('success', 'Successfully deleted');
    }
}
