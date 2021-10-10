<?php

namespace App\Http\Controllers\ProductSetup;

use App\Http\Controllers\Controller;
use App\Model\ProductSetup\DispensingModality;
use Illuminate\Http\Request;

class ModalitiesController extends Controller
{
    /**
     * @authr nyan
     * @date 9/7/21
     */
    protected $basePath = "enforcements.product_setups.modalities.";
    public function index()
    {
        $modalities = DispensingModality::orderByDesc('id')->get();
        return view($this->basePath."index", compact('modalities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'observance' => 'required',
            'desc' => 'required'
        ]);

        $modal = $request->id ? DispensingModality::find($request->id) : new DispensingModality();
        $modal->name = $request->name;
        $modal->description = $request->desc;
        $modal->observance = $request->observance;
        $modal->user_id = Auth()->user()->id;
        $modal->save();

        return redirect()->back()->with('success','Successfully saved');
    }

    public function ajaxGetModalities(Request $request)
    {
        $data = [];
        $id = $request->id;
        $unit = DispensingModality::find($id);
        if($unit) {
            $data = ['id' => $unit->id, 'name' => $unit->name, 'observance' => $unit->observance, 'desc' => $unit->description ];
        }

        return response()->json(['data' => $data]);
    }

    public function delete($id)
    {
        $unit = DispensingModality::find($id);
        $unit->delete();

        return redirect()->back()->with('success', 'Successfully deleted');
    }
}
