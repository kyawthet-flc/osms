<?php

namespace App\Http\Controllers\Client\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Client\ProductRequest;
use App\Model\Client\{ Shop, Product };
use App\Model\ProductSetup\ProductType;

class ActionController extends Controller
{
    protected $baseViewPath = 'clients.products.';

    protected $status = ['draft' => 'Draft', 'on_sale' => 'On Sale', 'inactive' => 'Inactive'];

    public function __construct()
    {
        // $this->middleware('creatable.shop')->only('create');
    }

    public function create()
    {
        return $this->toView('create',[
            'product' => new Product,
            'status' => $this->status,
            'shops' => Shop::pluck('name', 'id'),
            'productTypes' => ProductType::pluck('name', 'id')
        ]);
    }

    public function store(ProductRequest $request)
    {
        if ( $produt = Product::create($request->validated()) ) {
            return $this->jsonResponse(
                'success', 
                'Successfully created product and please continue for product list.', 
                route('product.edit', $produt)
            );
        }
        
        return $this->jsonResponse('error', 'Error to create product.', url()->previous());

    }

    public function edit(Request $request, Product $product)
    {
        $this->authorize('edit', $product);

        return $this->toView('edit', [
            'product' => $product,
            'status' => $this->status,
            'shops' => Shop::pluck('name', 'id'),
            'productTypes' => ProductType::pluck('name', 'id')
        ]);
    }

    public function update(ProductRequest $request, Product $product)
    {
        $this->authorize('update', $product);

        if ( $product->update($request->validated()) ) {
            return $this->jsonResponse(
                'success', 
                'Successfully updated and please continue for product list.', 
                route('product.edit', $product)
            );
        }

        return $this->jsonResponse('error', 'Error to update product.', url()->previous());    
    }

    public function delete(Request $request, Product $product)
    {
        $this->authorize('delete', $product);

        if ( $product->update(['status' => 'deleted']) ) {
            return $this->jsonResponse('success', 'Successfully deleted product.', url()->previous());
        }

        return $this->jsonResponse('error', 'Error to delete product.', url()->previous());    
    }
}