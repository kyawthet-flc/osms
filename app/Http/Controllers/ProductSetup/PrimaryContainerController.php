<?php

namespace App\Http\Controllers\ProductSetup;

use App\Http\Controllers\Controller;
use App\Model\ProductSetup\PrimaryContainer;
use Illuminate\Http\Request;

class PrimaryContainerController extends Controller
{
    /**
     * @authr nyan
     * @date 13/07/2021
     */
    protected $basePath = "enforcements.product_setups.primary_container.";
    public function index()
    {
        $result = PrimaryContainer::orderByDesc('id')->get();
        return view($this->basePath."index", compact('result'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => isset($request->id) ? 'required' : 'required|unique:primary_containers',
            'desc' => 'required'
        ]);

        $unit = $request->id ? PrimaryContainer::find($request->id) : new PrimaryContainer();
        $unit->name = $request->name;
        $unit->description = $request->desc;
        $unit->save();

        return redirect()->back()->with('success','Successfully saved');
    }

    public function ajaxGetPrimaryContainer(Request $request)
    {
        $data = [];
        $id = $request->id;
        $unit = PrimaryContainer::find($id);
        if($unit) {
            $data = ['id' => $unit->id, 'name' => $unit->name, 'desc' => $unit->description ];
        }

        return response()->json(['data' => $data]);
    }

    public function delete($id)
    {
        $unit = PrimaryContainer::find($id);
        $unit->delete();

        return redirect()->back()->with('success', 'Successfully deleted');
    }
}
