<?php

namespace App\Http\Controllers\Client\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Client\ProductRequest;
use App\Model\Client\{ Shop, Product };
use App\Model\File;
use App\Model\ProductSetup\{ProductType, ProductAttr};
use App\Services\FileUploader;

class ActionController extends Controller
{
    protected $baseViewPath = 'clients.products.';

    protected $status = ['draft' => 'Draft', 'on_sale' => 'On Sale', 'inactive' => 'Close'];

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

    public function loadSizeColor(Request $request)
    {
        if ( $request->productId ) {
            return $this->jsonResponse('success', 'Successfully fetched.', '#', $this->sizeColorJson($request->productId));
        }

        return $this->jsonResponse('error', 'Error to fetch.', '#'); 
    }

    public function saveSizeColor(Request $request)
    {
        $product = Product::find($request->productId);
        if( $product = Product::find($request->productId)->productAttrs()->create([
            'entity_name' => 'products',
            'attribute' => strtolower($request->attribute),
            'value' => strtolower($request->attribute) == 'size'? strtoupper(strtolower($request->value)): ProductAttr::createColorCode($product),
            'remark' => $request->remark,
            'additional' => $this->generateColorCodeFromFile($request->file('colorFiles')),
        ]) ) {
           return $this->jsonResponse('success', 'Successfully saved product.', '#', $this->sizeColorJson($request->productId));
        }

        return $this->jsonResponse('error', 'Error to save.', '#'); 

    }

    public function deleteSizeColor(Request $request, ProductAttr $productAttr)
    {
        if ( $file = File::find($productAttr->additional) ) {
            $file->deleteSingle();
            $file->delete();
            $productAttr->delete();
            return $this->jsonResponse('success', 'Successfully deleted.', '#');
        } else {
            $productAttr->delete();
            return $this->jsonResponse('success', 'Successfully deleted.', '#');
        }

        return $this->jsonResponse('error', 'Error to delete.','#');  
    }

    protected function generateColorCodeFromFile($file)
    {
        if($file) {
           return (new FileUploader())->uploadSingle($file, 'color_codes', false);
        }
        return '';
    }

    /*
    @php 
    $encrptedImg = base64_encode(App\Model\File::find($shop->logo)->decryptFile())
    @endphp
    <img class="magnific-popup-img mt-1 mb-3" 
        style="width: 90px;height: 80px;" 
        src="data:image/png;base64,{!! $encrptedImg !!}" 
        href="data:image/png;base64,{!! $encrptedImg !!}" alt="Logo" />
    @endif*/

    protected function sizeColorJson($productId)
    {
        $sizeTemplate = '';
        $colorTemplate = '';

        foreach(Product::with(['productAttrs.image'])->find($productId)->productAttrs as $attr) {
            if ( 'size' === $attr->attribute ) {
                $tempTpl = '<span class="badge badge-dark mr-1 delete-size-color-wrapper">'.($attr->value).'<a ajax-type="delete-size-color" class="p-1 pr-0 text-danger" href="'.route('product.size_color.delete',['productAttr' => $attr->id]).'"><i class="mdi mdi-delete"></i></a></span>';
                $sizeTemplate .= $tempTpl;
            } else {
                $encrptedImg = base64_encode($attr->image->decryptFile());
                $tempTpl = '<span class="badge badge-dark mr-1 delete-size-color-wrapper"><img class="magnific-popup-img" 
                style="width: 15px;height: 15px" src="data:image/'.strtolower($attr->image->file_extension).';base64,'.$encrptedImg.'" href="data:image/'.strtolower($attr->image->file_extension).';base64,'.$encrptedImg.'" alt="Image" />&nbsp;&nbsp;&nbsp;'.($attr->value).'<a ajax-type="delete-size-color" class="p-1 pr-0 text-danger" href="'.route('product.size_color.delete',['productAttr' => $attr->id]).'"><i class="mdi mdi-delete"></i></a></span>';
                $colorTemplate .= $tempTpl;
            }
        }
        return [
            'sizeTemplate' => $sizeTemplate,
            'colorTemplate' => $colorTemplate
        ];
    }
}
/*
 <img class="magnific-popup-img mt-1 mb-3" 
*/