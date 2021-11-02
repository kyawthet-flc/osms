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
            return $this->toView('variations-list',[
                'product' => $product,
                'subProduct' => new SubProduct,
                'subProducts' => $product->subProducts
            ]);
        }
        return back();
    }

    public function getForm($sku, SubProduct $subProduct=null)
    {
        $product = Product::whereSku($sku)->first();

        if ( $subProduct ) {
            $sizes = $product->productAttrs->where('attribute', 'size')->where('value', $subProduct->size)->pluck('value');
            $colors = $product->productAttrs->where('attribute', 'color')->where('value', $subProduct->color)->pluck('value');
        } else {
            $sizes = $product->productAttrs->where('attribute', 'size')->pluck('value');
            $colors = $product->productAttrs->where('attribute', 'color')->pluck('value');
        }
      
        $data = [
            'product' => $product,
            'subProduct' => $subProduct? $subProduct:new SubProduct,
            'action' => route('product.sub_product.store',['sku' => $sku, 'subProduct' => $subProduct]), 
            'method' => 'post',
            'submitLabel' => $subProduct? 'Update':'Create', 
            'confirmationText' => $subProduct? 'Are you sure to update?': 'Are you sure to create?',
            'sizes' => $sizes,
            'colors' => $colors,
            'selectedSize' =>  $subProduct?  $subProduct->size: ''
        ];

        if ( request()->ajax() ) {
            return $this->jsonResponse('success', 'Successfully Fetched.', '#',[
                'form' => view($this->baseViewPath . 'variation-form', $data)->render(),
                'assets' => ['js' => js_assets('secondary'), 'css' => []]
            ]);
        }
        return view($this->baseViewPath . 'variations-form-container', $data);
    }


    public function getVariationSizeColor($sku, SubProduct $subProduct=null)
    {
        // Get by selected size
        // $selected_size = request('selected_size');
        $product = Product::whereSku($sku)->first();    
      
        $data = [
            'product' => $product,
            'subProduct' => $subProduct? $subProduct:new SubProduct,
            'action' => route('product.sub_product.store',['sku' => $sku, 'subProduct' => $subProduct]), 
            'method' => 'post',
            'submitLabel' => $subProduct? 'Update':'Create', 
            'confirmationText' => $subProduct? 'Are you sure to update?': 'Are you sure to create?',
            'sizes' => $product->productAttrs->where('attribute', 'size')->pluck('value'),
            'colors' => $product->productAttrs->where('attribute', 'color')->pluck('value'),
            'selectedSize' => request('selected_size'),
        ];

        return $this->jsonResponse('success', 'Successfully Fetched.', '#',[
            'form' => view($this->baseViewPath . 'variation-form-by-size', $data)->render()
        ]);
    }

    // public function store(Request $request, $sku, SubProduct $subProduct=null)
    public function store(SubProductRequest $request, $sku, SubProduct $subProduct=null)
    {
        $product = Product::whereSku($sku)->first();

        if ( $subProduct ) {
            foreach($request->variations as $singleRequest) {
                $subProduct->update($this->parameters($singleRequest, $subProduct));
            }
            return $this->jsonResponse('success', 'Successfully update Sub Product.', request('redirectUrl')??url()->previous());
        } else {
            foreach($request->variations as $singleRequest) {
                if ( $subProduct = SubProduct::whereSize($singleRequest['size'])->whereColor($singleRequest['color'])->first() ) {
                    $subProduct->update($this->parameters($singleRequest, $subProduct));
                } else {
                    $product->subProducts()->create($this->parameters($singleRequest));
                }
            }
            return $this->jsonResponse('success', 'Successfully create Sub Product.', request('redirectUrl')??url()->previous());
        }

        return $this->jsonResponse('error', 'Error to save Sub Product.', request('redirectUrl')??url()->previous());
       
    }

    public function parameters($request, $subProduct=null)
    {
        $qtyAvaiable = $request['quantity_avaiable'];
        $qtyLeft = $request['quantity_avaiable'];

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
            "color" => $request['color'],
            "size" => $request['size'],
            "quantity_bought" => $qtyAvaiable,
            "quantity_avaiable" => $qtyAvaiable,
            "quantity_left" => $qtyLeft,
            "unit" => $request['unit'],
            "price_bought" => $request['price_bought'],
            "price_original" => $request['price_bought'],
            "price_sold" => $request['price_sold'],
            "desc" => isset($request['desc'])? $request['desc']: null
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