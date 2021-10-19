<?php

namespace App\Http\Controllers\Client\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Client\{
    Product, 
    SubProduct,
    SubProductImage
};
use App\Model\File;
use App\Http\Requests\Client\SubProductRequest;
use App\Services\FileUploader;

class SubProductController extends Controller
{
    protected $baseViewPath = 'clients.products.';

    public function list($sku)
    {
        if ( $product = Product::whereSku($sku)->first() ) {
            return $this->toView('sub_product_list',[
                'product' => $product,
                'subProduct' => new SubProduct,
                'subProducts' => $product->subProducts
            ]);
        }
        return back();
    }

    public function getForm($sku, SubProduct $subProduct=null)
    {
        // dd($subProduct->subProductImages[0]->image->showNormal());
        $product = Product::whereSku($sku)->first();

        return $this->jsonResponse('success', 'Successfully Fetched.', '#',[
            'form' => view($this->baseViewPath . '_sub_product_form',[
                'product' => $product,
                'subProduct' => $subProduct? $subProduct:new SubProduct,
                'action' => route('product.sub_product.store',['sku' => $sku, 'subProduct' => $subProduct]), 
                'method' => 'post',
                'submitLabel' => $subProduct? 'Update':'Create', 
                'confirmationText' => $subProduct? 'Are you sure to update?': 'Are you sure to create?'
            ])->render(),
            'assets' => array(
                'js' => js_assets('secondary'),
                'css' => []
            )
        ]);
    }

    public function store(SubProductRequest $request, $sku, SubProduct $subProduct=null)
    {
        $product = Product::whereSku($sku)->first();

        if ( $subProduct && $subProduct->update($this->parameters($request)) ) {
            $subProduct->handleSubProductImages();
            return $this->jsonResponse('success', 'Successfully update Sub Product.', request('redirectUrl')??url()->previous());
        } else {
            $subProduct = $product->subProducts()->create($this->parameters($request));
            return $this->jsonResponse('success', 'Successfully create Sub Product.', request('redirectUrl')??url()->previous());
        }

        return $this->jsonResponse('error', 'Error to save Sub Product.', request('redirectUrl')??url()->previous());
       
    }

    public function parameters($request)
    {
        return [
            "color" => $request->color,
            "size" => $request->size,
            "quantity_bought" => $request->quantity_bought,
            "quantity_avaiable" => $request->quantity_avaiable,
            "quantity_left" => $request->quantity_avaiable,
            "unit" => $request->unit,
            "price_bought" => $request->price_bought,
            "price_original" => $request->price_bought,
            "price_sold" => $request->price_sold,
            "desc" => $request->desc
        ];
    }

    public function deleteSubProductImage(Request $request, SubProductImage $subProductImage)
    {
        if( $subProductImage->image->delete() ) {
            $subProductImage->delete();
            return $this->jsonResponse('success', 'Successfully Deleted.', request('redirectUrl')??url()->previous());
        }
        return $this->jsonResponse('error', 'Error to delete.', request('redirectUrl')??url()->previous());
    }

    public function deleteSubProduct(Request $request, SubProduct $subProduct)
    {
        if( $subProduct->delete() ) {
            return $this->jsonResponse('success', 'Successfully Deleted.', request('redirectUrl')??url()->previous());
        }
        return $this->jsonResponse('error', 'Error to delete.', request('redirectUrl')??url()->previous());
    }
    
}