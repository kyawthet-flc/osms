<?php

namespace App\Http\Controllers\Client\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Http\Requests\Client\ProductSupplymentRequest;
use App\Model\Client\{ Shop, Product, ProductSupplyment, Supplier };

class ProductSupplymentController extends Controller
{
    protected $baseViewPath = 'clients.products.product-supplyments.';

    public function create()
    {
        $data = [
            'productId' => request('productId'),
            'productSupplyment' => new ProductSupplyment,
            'suppliers' => Supplier::pluck('name', 'id'),
        ];
        
        if ( request()->ajax() ) {
            return $this->jsonResponse('success', 'Successfully Fetched.', '#',[
                'form' => view($this->baseViewPath . 'create_ajax', $data
                )->render()
            ]);
        }

        return $this->toView('create', $data);
    }

    public function store(ProductSupplymentRequest $request)
    {
        if ( ProductSupplyment::create($request->validated()) ) {
            return $this->jsonResponse(
                'success', 
                'Successfully created Product Supplyment.', 
                url()->previous()
            );
        }
        
        return $this->jsonResponse('error', 'Error to create Product Supplyment.', url()->previous());

    }

    public function edit(Request $request, ProductSupplyment $productSupplyment)
    {
        $data = [
            'productId' => $productSupplyment->product_id,
            'productSupplyment' => $productSupplyment,
            'suppliers' => Supplier::pluck('name', 'id'),
        ];
        if ( request()->ajax() ) {
            return $this->jsonResponse('success', 'Successfully Fetched.', '#',[
                'form' => view($this->baseViewPath . 'edit_ajax', $data
                )->render()
            ]);
        }

        return $this->toView('edit', $data);
    }

    public function update(ProductSupplymentRequest $request, ProductSupplyment $productSupplyment)
    {

        if ( $productSupplyment->update($request->validated()) ) {
            return $this->jsonResponse(
                'success', 
                'Successfully updated Product Supplyment.',
                url()->previous()
            );
        }

        return $this->jsonResponse('error', 'Error to update Product Supplyment.', url()->previous());    
    }

    public function delete(Request $request, ProductSupplyment $productSupplyment)
    {
        if ( $productSupplyment->delete() ) {
            return $this->jsonResponse('success', 'Successfully deleted Product Supplyment.', url()->previous());
        }

        return $this->jsonResponse('error', 'Error to delete Product Supplyment.', url()->previous());    
    }
}