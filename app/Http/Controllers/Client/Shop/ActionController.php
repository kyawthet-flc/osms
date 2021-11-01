<?php

namespace App\Http\Controllers\Client\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Client\ShopRequest;

use App\Services\FileUploader;
use App\Model\Client\Shop;
use App\Model\GeneralSetup\Township;

class ActionController extends Controller
{
    protected $baseViewPath = 'clients.shops.';

    protected $status = ['active' => 'Active', 'inactive' => 'Inactive'];

    public function __construct()
    {
        $this->middleware('creatable.shop')->only('create');
    }

    public function create()
    {
        return $this->toView('create',[
            'shop' => new Shop,
            'status' => $this->status,
            'townships' => (new Township)->compiledTsDisDiv()
        ]);
    }

    public function store(ShopRequest $request)
    // public function store(Request $request)
    {
        if ( Shop::create( $this->prepareParams($request) ) ) {
            return $this->jsonResponse('success', 'Successfully created shop.', url()->previous());
        }
        
        return $this->jsonResponse('error', 'Error to create shop.', url()->previous());

    }

    public function edit(Request $request, Shop $shop)
    {
        $this->authorize('edit', $shop);

        return $this->toView('edit', [
            'shop' => $shop,
            'status' => $this->status,
            'townships' => (new Township)->compiledTsDisDiv()            
        ]);
    }

    public function update(ShopRequest $request, Shop $shop)
    {
        $this->authorize('update', $shop);

        if ( $shop->update( $this->prepareParams($request) ) ) {
            return $this->jsonResponse('success', 'Successfully updated shop.', url()->previous());
        }

        return $this->jsonResponse('error', 'Error to update shop.', url()->previous());    
    }

    public function delete(Request $request, Shop $shop)
    {
        $this->authorize('delete', $shop);

        if ( $shop->update(['status' => 'deleted']) ) {
            return $this->jsonResponse('success', 'Successfully deleted shop.', url()->previous());
        }

        return $this->jsonResponse('error', 'Error to delete shop.', url()->previous());    
    }    

    protected function prepareParams($request)
    {
        $validated = $request->validated();
        $township = Township::find($request->ts_id);
        $validated['user_id'] = auth()->user()->id;
        $validated['dis_id'] = $township->district->id;
        $validated['div_id'] = $township->district->division->id;

        if ( $request->hasFile('logo') ) {
           $validated['logo'] = (new FileUploader())->uploadSingle($request->logo, 'shop_logos');
        } else {
            unset($validated['logo']);
        }
        // dd($validated);
        return $validated;
    }

}