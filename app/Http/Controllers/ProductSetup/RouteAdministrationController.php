<?php

namespace App\Http\Controllers\ProductSetup;

use App\Http\Controllers\Controller;
use App\Model\ProductSetup\RouteOfAdministration;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class RouteAdministrationController extends Controller
{
    /**
     * @authr nyan
     * @date 13/07/2021
     */
    protected $basePath = "enforcements.product_setups.route_of_administration.";
    public function index()
    {
        $result = RouteOfAdministration::orderByDesc('id')->get();
        return view($this->basePath."index", compact('result'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'desc' => 'required'
        ]);

        $unit = $request->id ? RouteOfAdministration::find($request->id) : new RouteOfAdministration();
        $unit->name = $request->name;
        $unit->description = $request->desc;
        $unit->save();

        return redirect()->back()->with('success','Successfully saved');
    }

    public function ajaxGetRouteAdministration(Request $request)
    {
        $data = [];
        $id = $request->id;
        $unit = RouteOfAdministration::find($id);
        if($unit) {
            $data = ['id' => $unit->id, 'name' => $unit->name, 'desc' => $unit->description ];
        }

        return response()->json(['data' => $data]);
    }

    public function delete($id)
    {
        $unit = RouteOfAdministration::find($id);
        $unit->delete();

        return redirect()->back()->with('success', 'Successfully deleted');
    }
}
