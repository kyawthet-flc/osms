<?php

namespace App\Http\Controllers\Client\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
 
use App\Model\Client\{ Shop, Product, Supplier };

class SupplierController extends Controller
{
    protected $baseViewPath = 'clients.products.suppliers.';

    public function create()
    {        
        if ( request()->ajax() ) {
            return $this->jsonResponse('success', 'Successfully Fetched.', '#',[
                'form' => view($this->baseViewPath . 'create_ajax', ['supplier' => new Supplier]
                )->render()
            ]);
        }

        return $this->toView('create', ['supplier' => new Supplier]);
    }

    public function store(Request $request)
    {
        if ( $Supplier = Supplier::create($request->validated()) ) {
            return $this->jsonResponse(
                'success', 
                'Successfully created Supplier.', 
                route('supplier.index')
            );
        }
        
        return $this->jsonResponse('error', 'Error to create Supplier.', url()->previous());

    }

    public function edit(Request $request, Supplier $supplier)
    {
        return $this->toView('edit', [
            'supplier' => $supplier
        ]);
    }

    public function update(Request $request, Supplier $supplier)
    {

        if ( $supplier->update($request->validated()) ) {
            return $this->jsonResponse(
                'success', 
                'Successfully Supplier.',
                url()->previous()
            );
        }

        return $this->jsonResponse('error', 'Error to update Supplier.', url()->previous());    
    }

    public function delete(Request $request, Supplier $supplier)
    {
        if ( $supplier->delete() ) {
            return $this->jsonResponse('success', 'Successfully deleted Supplier.', url()->previous());
        }

        return $this->jsonResponse('error', 'Error to delete Supplier.', url()->previous());    
    }
}