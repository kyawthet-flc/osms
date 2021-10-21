<?php

namespace App\Http\Controllers\Client\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Client\Product;
use App\Model\ProductSetup\ProductType;

class IndexController extends Controller
{
    protected $baseViewPath = 'clients.products.';

    public function index()
    {
        return $this->toView('index',[
            'lists' => Product::with(['shop', 'productType', 'subProducts'])->whereHas('shop', function($q){
                $q->where('user_id', auth()->user()->id);
            })->paginate()
        ]);
    }

    public function show(Request $request,Product $product)
    {
        $data = [
            'product' => $product,
            'productTypes' => ProductType::pluck('name', 'id')
        ];

        if ( $request->ajax() ) {            
            return $this->jsonResponse('success', 'Successfully Fetched.', request('redirectUrl')??url()->previous(), [
                'template' => view($this->baseViewPath . 'show_ajax',  $data)->render()
            ]);
        }

        return $this->toView('show', $data);
    }
}