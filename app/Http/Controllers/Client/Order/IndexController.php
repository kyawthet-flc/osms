<?php

namespace App\Http\Controllers\Client\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Client\Order;

class IndexController extends Controller
{
    protected $baseViewPath = 'clients.orders.';

    public function index()
    {
        
        return $this->toView('index',[
            'paymentTypes' =>  ['1' => 'Cash On Delivery', '2' => 'Mobile Payment'],
            'lists' => Order::with(['customer'])->whereHas('customer', function($q){
                $q->whereIn('shop_id', auth()->user()->shops->pluck('id')->toArray());
            })->paginate(5)
            // 'lists' => auth()->user()->shops()->with(['township', 'district', 'division'])->paginate(1)
        ]);
    }

    public function show(Request $request,Order $order)
    {
        $data = [
            'order' => $order,
            'paymentTypes' =>  ['1' => 'Cash On Delivery', '2' => 'Mobile Payment'],
            'customer' => $order->customer,
            'listedVariations' => $order? $order->orderDetails()->with(['product', 'subProduct'])->orderBy('product_id', 'desc')->get(): []
        ];

        if ( $request->ajax() ) {            
            return $this->jsonResponse('success', 'Successfully Fetched.', request('redirectUrl')??url()->previous(), [
                'template' => view($this->baseViewPath . 'show_ajax',  $data)->render()
            ]);
        }

        return $this->toView('show', $data);
    }
}