<?php

namespace App\Http\Controllers\Client\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Client\{Product, SubProduct};
use App\Http\Requests\Client\SubProductRequest;

class SubProductController extends Controller
{
    protected $baseViewPath = 'clients.products.';

    public function list($sku)
    {
        $product = Product::whereSku($sku)->first();

        return $this->toView('sub_product_list',[
            'product' => $product,
            'subProducts' => $product->subProducts
        ]);
    }

    public function store(SubProductRequest $request, $sku)
    {
        $product = Product::whereSku($sku)->first();
    }
}