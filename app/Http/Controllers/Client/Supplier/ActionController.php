<?php

namespace App\Http\Controllers\Client\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Client\SupplierRequest;
use App\Model\Client\Supplier;
use App\Model\GeneralSetup\Township;

class ActionController extends Controller
{
    protected $baseViewPath = 'clients.suppliers.';


    public function __construct()
    {
        // $this->middleware('creatable.shop')->only('create');
    }

    public function create()
    {
        return $this->toView('create',[
            'supplier' => new Supplier,
            'shops' => auth()->user()->shops->pluck('name', 'id'),
            'townships' => (new Township)->compiledTsDisDiv()
        ]);
    }

    public function store(SupplierRequest $request)
    {
        if (  $supplier = Supplier::create( $this->prepareParams($request) ) ) {   
            return $this->jsonResponse('success', 'Successfully created shop.',  route('supplier.index'));
        }
        
        return $this->jsonResponse('error', 'Error to create shop.', request('redirectUrl')? :url()->previous());

    }

    public function edit(Request $request, Supplier $supplier)
    {
        $this->authorize('edit', $supplier);

        return $this->toView('edit',[
            'supplier' => $supplier,
            'townships' => (new Township)->compiledTsDisDiv()
        ]);
    }

    public function update(SupplierRequest $request, Supplier $supplier)
    {
        $this->authorize('update', $supplier);

        if ( $supplier->update( $this->prepareParams($request) ) ) {
            return $this->jsonResponse('success', 'Successfully updated customer.', request('redirectUrl')?? url()->previous());
        }

        return $this->jsonResponse('error', 'Error to update customer.', request('redirectUrl')??url()->previous());    
    }

    public function delete(Request $request, Supplier $supplier)
    {
        $this->authorize('delete', $supplier);

        if ( $supplier->delete() ) {
            return $this->jsonResponse('success', 'Successfully deleted customer.',request('redirectUrl')?? url()->previous());
        }

        return $this->jsonResponse('error', 'Error to delete customer.', request('redirectUrl')??url()->previous());    
    }    

    protected function prepareParams($request)
    {
        $validated = $request->validated();
        $township = Township::find($request->ts_id);
        $validated['user_id'] = auth()->user()->id;
        $validated['dis_id'] = $township->district->id;
        $validated['div_id'] = $township->district->division->id;
        return $validated;
    }

}