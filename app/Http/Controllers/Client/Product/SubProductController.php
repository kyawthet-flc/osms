<?php

namespace App\Http\Controllers\Client\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Client\{
    Product, 
    SubProduct,
    SubProductImage
};
use App\Model\ProductSetup\ProductAttr;
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
        $productAttrs = ProductAttr::whereEntityName('product_type')->whereEntityId($product->product_type_id)->get();

        $data = [
            'product' => $product,
            'subProduct' => $subProduct? $subProduct:new SubProduct,
            'action' => route('product.sub_product.store',['sku' => $sku, 'subProduct' => $subProduct]), 
            'method' => 'post',
            'submitLabel' => $subProduct? 'Update':'Create', 
            'confirmationText' => $subProduct? 'Are you sure to update?': 'Are you sure to create?',
            'sizes' => $productAttrs->where('attribute', 'Size')->pluck('value'),
            'colors' => $productAttrs->where('attribute', 'Color')->pluck('value')
        ];

        if ( request()->ajax() ) {
            return $this->jsonResponse('success', 'Successfully Fetched.', '#',[
                'form' => view($this->baseViewPath . '_sub_product_form', $data)->render(),
                'assets' => array(
                    'js' => js_assets('secondary'),
                    'css' => []
                )
            ]);
        }
        return view($this->baseViewPath . 'sub_product_form', $data);
    }

    public function store(SubProductRequest $request, $sku, SubProduct $subProduct=null)
    {
        $product = Product::whereSku($sku)->first();

        if ( $subProduct && $subProduct->update($this->parameters($request,  $subProduct)) ) {
            $subProduct->handleSubProductImages();
            return $this->jsonResponse('success', 'Successfully update Sub Product.', request('redirectUrl')??url()->previous());
        } else {
            $subProduct = $product->subProducts()->create($this->parameters($request));
            return $this->jsonResponse('success', 'Successfully create Sub Product.', request('redirectUrl')??url()->previous());
        }

        return $this->jsonResponse('error', 'Error to save Sub Product.', request('redirectUrl')??url()->previous());
       
    }

    public function parameters($request, $subProduct=null)
    {
        $qtyAvaiable = $request->quantity_avaiable;
        $qtyLeft = $request->quantity_avaiable;

        if ( $subProduct ) {
            if ( $qtyAvaiable > $subProduct->quantity_avaiable ) {
                $qtyLeft = $subProduct->quantity_left + ($qtyAvaiable - $subProduct->quantity_avaiable);
            } else if ( $qtyAvaiable < $subProduct->quantity_avaiable ) {
                $qtyLeft = $subProduct->quantity_left - ( $subProduct->quantity_avaiable - $qtyAvaiable);
            } else {
                $qtyLeft = $subProduct->quantity_left;
            }
        }

        return [
            "color" => $request->color,
            "size" => $request->size,
            "quantity_bought" => $qtyAvaiable,
            "quantity_avaiable" => $qtyAvaiable,
            "quantity_left" => $qtyLeft,
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