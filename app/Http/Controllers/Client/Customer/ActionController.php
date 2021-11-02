<?php

namespace App\Http\Controllers\Client\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Client\CustomerRequest;
use App\Model\Client\Customer;
use App\Model\GeneralSetup\Township;

class ActionController extends Controller
{
    protected $baseViewPath = 'clients.customers.';

    protected $status = ['active' => 'Active', 'inactive' => 'Inactive'];

    public function __construct()
    {
        // $this->middleware('creatable.shop')->only('create');
    }

    public function create()
    {
        return $this->toView('create',[
            'customer' => new Customer,
            'status' => $this->status,
            'shops' => auth()->user()->shops->pluck('name', 'id'),
            'townships' => (new Township)->compiledTsDisDiv()
        ]);
    }

    public function store(CustomerRequest $request)
    {
        if (  $customer = Customer::create( $this->prepareParams($request) ) ) {            
            $data = ['customer_id' => $customer->id] + (request('urlSegments')?json_decode(request('urlSegments'), true): []);
            $urlObj = http_build_query($data);
            return $this->jsonResponse('success', 'Successfully created shop.', request('redirectUrl')?(request('redirectUrl') . '?'. $urlObj ):url()->previous());
        }
        
        return $this->jsonResponse('error', 'Error to create shop.', request('redirectUrl')? :url()->previous());

    }

    public function edit(Request $request, Customer $customer)
    {
        $this->authorize('edit', $customer);

        return $this->toView('edit',[
            'customer' => $customer,
            'status' => $this->status,
            'shops' => auth()->user()->shops->pluck('name', 'id'),
            'townships' => (new Township)->compiledTsDisDiv()
        ]);
    }

    public function update(CustomerRequest $request, Customer $customer)
    {
        $this->authorize('update', $customer);

        if ( $customer->update( $this->prepareParams($request) ) ) {
            return $this->jsonResponse('success', 'Successfully updated customer.', request('redirectUrl')?? url()->previous());
        }

        return $this->jsonResponse('error', 'Error to update customer.', request('redirectUrl')??url()->previous());    
    }

    public function delete(Request $request, Customer $customer)
    {
        $this->authorize('delete', $customer);

        if ( $customer->delete() ) {
            return $this->jsonResponse('success', 'Successfully deleted customer.',request('redirectUrl')?? url()->previous());
        }

        return $this->jsonResponse('error', 'Error to delete customer.', request('redirectUrl')??url()->previous());    
    }    

    protected function prepareParams($request)
    {
        $validated = $request->validated();
        $township = Township::find($request->ts_id);
        $validated['dis_id'] = $township->district->id;
        $validated['div_id'] = $township->district->division->id;
        return $validated;
    }

}