<?php

namespace App\Http\Controllers\ProductSetup;

use App\Http\Controllers\Controller;
use App\Model\ProductSetup\StorageCondition;
use Illuminate\Http\Request;

class StorageConditionController extends Controller
{
    /**
     * @authr nyan
     * @date 13/07/2021
     */
    protected $basePath = "enforcements.product_setups.storage_condition.";
    public function index()
    {
        $result = StorageCondition::orderByDesc('id')->get();
        return view($this->basePath."index", compact('result'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => isset($request->id) ? 'required' : 'required|unique:storage_conditions',
            'observance' => 'required',
            'desc' => 'required'
        ]);

        $unit = $request->id ? StorageCondition::find($request->id) : new StorageCondition();
        $unit->name = $request->name;
        $unit->observance = $request->observance;
        $unit->description = $request->desc;
        $unit->user_id = Auth()->user()->id;
        $unit->save();

        return redirect()->back()->with('success','Successfully saved');
    }

    public function ajaxGetStorageCondition(Request $request)
    {
        $data = [];
        $id = $request->id;
        $unit = StorageCondition::find($id);
        if($unit) {
            $data = ['id' => $unit->id, 'name' => $unit->name, 'observance' => $unit->observance, 'desc' => $unit->description ];
        }

        return response()->json(['data' => $data]);
    }

    public function delete($id)
    {
        $unit = StorageCondition::find($id);
        $unit->delete();

        return redirect()->back()->with('success', 'Successfully deleted');
    }
}
