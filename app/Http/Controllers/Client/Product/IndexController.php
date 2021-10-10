<?php

namespace App\Http\Controllers\Client\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Client\Product;

class IndexController extends Controller
{
    protected $baseViewPath = 'clients.products.';

    public function index()
    {
        return $this->toView('index',[
            'lists' => Product::with(['shop', 'productType'])->whereHas('shop', function($q){
                $q->where('user_id', auth()->user()->id);
            })->paginate()
        ]);
    }

    public function show()
    {
        return $this->toView('show');        
    }
}