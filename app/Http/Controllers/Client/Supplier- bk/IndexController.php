<?php

namespace App\Http\Controllers\Client\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Client\Supplier;

class IndexController extends Controller
{
    protected $baseViewPath = 'clients.suppliers.';

    public function index()
    {
        return $this->toView('index',[
            'lists' => Supplier::paginate()
        ]);
    }

    public function show(Request $request,Supplier $supplier)
    {
        $data = [
            'product' => $product,
            'productTypes' => ProductType::pluck('name', 'id')
        ];

        if ( $request->ajax() ) {            
            return $this->jsonResponse('success', 'Successfully Fetched.', request('redirectUrl')??url()->previous(), [
                'template' => view($this->baseViewPath . 'show_ajax', ['supplier' => $supplier])->render()
            ]);
        }
        return $this->toView('show', ['supplier' => $supplier]);
    }
}