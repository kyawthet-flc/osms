<?php

namespace App\Http\Controllers\Client\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Client\OrderRequest;
use App\Model\Client\{
    Product,
    SubProduct,
    Shop,
    Order,
    OrderDetail,
    Customer,
    ProductType
};
use App\Model\GeneralSetup\Township;

class ActionController extends Controller
{
    protected $baseViewPath = 'clients.orders.';

    protected $orderStatus = [
        'ordered' => 'Ordered', 
        'delivered' => 'Delivered',
        'received' => 'Received',
        'done' => 'Done'
    ];
    protected $paymentStatus = ['unpaid' => 'Unpaid', 'paid' => 'Paid'];
    protected $customerStatus = ['active' => 'Active', 'inactive' => 'Inactive'];
    public function __construct()
    {
        // $this->middleware('creatable.shop')->only('create');
    }

    public function create()
    {
        $order = Order::whereCode(request('code'))->first()?? new Order;
        $customer = Customer::find(request('customer_id', $order->customer_id))?? new Customer;
        
        if ( request('customer_id') && is_null(request('code', null)) ) {
            $order = Order::create(['customer_id' => request('customer_id') ]);
        } else if ( request('customer_id') && request('code') ) {
            Order::whereCode(request('code'))->update(['customer_id' => request('customer_id') ]);
        }

        $shops = auth()->user()->shops->pluck('name', 'id');

        $data = [
            'order' => $order,
            'orderStatus' => $this->orderStatus,
            'paymentStatus' => $this->paymentStatus,
            'status' => $this->customerStatus,
            'paymentTypes' =>  ['1' => 'Cash On Delivery', '2' => 'Mobile Payment'],//ProductType::pluck('name', 'id'),
            'customers' => Customer::whereIn('shop_id', array_flip($shops->toArray()))->get(),
            'products' => Product::where('shop_id', $customer->shop_id??0)->whereIn('status', ['on_sale'])->pluck('name', 'id'),
            'townships' => request('createCustomer') == 'yes'?(new Township)->compiledTsDisDiv(): [],
            'shops' => $shops,
            'customer' => new Customer,
            'code' => request('code', $order->code),
            'listedVariations' => $order? $order->orderDetails()->with(['product', 'subProduct'])->orderBy('product_id', 'desc')->get(): []
        ];

        return $this->toView('create', $data);
    }

    public function store(OrderRequest $request)
    // public function store(Request $request)
    {
        if ( $order = Order::whereCode($request->code)->first() ) {
            $order->update($this->prepareParams($request));
            return $this->jsonResponse('success', "Order Updated At " . $order->updated_at->format('d-m-Y'), url()->previous());
        } else if ( Order::create( $this->prepareParams($request) ) ) {
            return $this->jsonResponse('success', 'Order Created.', url()->previous());
        }
        
        return $this->jsonResponse('error', 'Error to create order.', url()->previous());

    }

    // public function edit(Request $request, Order $order)
    // {
    //     $this->authorize('edit', $order);

    //     return $this->toView('edit', [
    //         'order' => $order,
    //         'status' => $this->status,
    //         'townships' => (new Township)->compiledTsDisDiv()            
    //     ]);
    // }

    // public function update(OrderRequest $request, Order $order)
    // {
    //     $this->authorize('update', $order);

    //     if ( $order->update( $this->prepareParams($request) ) ) {
    //         return $this->jsonResponse('success', 'Order Updated.', url()->previous());
    //     }

    //     return $this->jsonResponse('error', 'Error to update Order.', url()->previous());    
    // }

    public function delete(Request $request, Order $order)
    {
        if ( $order->delete() ) {
        // if ( $order->update(['status' => 'deleted']) ) {
        
            return $this->jsonResponse('success', 'Order Deleted.', url()->previous());
        }

        return $this->jsonResponse('error', 'Error to delete shop.', url()->previous());    
    }

    public function saveProductAttributes(Request $request)
    {
        $request->validate([
            'productId' => 'required',
            'subProductId' => 'required',
            'customerId' => 'required',
            'code' => 'required',
            'variations.quantity' => 'required|numeric',
            'variations.size' => 'required',
            'variations.color' => 'required'
        ]);

        $subProductOrders = request('variations');
        // Check already exist or not!
        // $orderDetail = orderDetail::whereProductId(request('productId'))->whereSubProductId(request('subProductId'))->first();
        // $orderId = $orderDetail? $orderDetail->order_id: 0;

        if ( $order = Order::whereCode(request('code'))->first() ) {
            
            $subProduct = SubProduct::find(request('subProductId'));

            if ( $subProductOrders['quantity'] > $subProduct->quantity_left ) {
                return $this->jsonResponse('error', 'Requested quantity more than avaiable.', '#');
            }

            if ( $orderDetail = orderDetail::whereOrderId($order->id)->whereProductId(request('productId'))->whereSubProductId(request('subProductId'))->first() ) { 

                $newQty = $orderDetail->quantity + $subProductOrders['quantity'];
                $orderDetail->update([
                    'product_id' => request('productId'),
                    'quantity' => $newQty,
                    'sub_product_id' => $subProduct->id,
                    'sub_total_price' => $subProduct->price_sold * $newQty,
                ]);
                return $this->jsonResponse('success', 'Order Updated.', request('redirectUrl')??url()->previous());
            } else {
                $order->orderDetails()->create([
                    'product_id' => request('productId'),
                    'quantity' => $subProductOrders['quantity'],
                    'sub_product_id' => $subProduct->id,
                    'sub_total_price' => $subProduct->price_sold * ((int)$subProductOrders['quantity']),
                ]);
                return $this->jsonResponse('success', 'Order Created.', request('redirectUrl')??url()->previous());
            }

        }

        return $this->jsonResponse('error', 'Error to create order.', request('redirectUrl')??url()->previous());
    }

    public function deleteProductAttribute(Request $request,Order $order, OrderDetail $orderDetail, Product $product, SubProduct $subProduct, $quantity )
    {
        if( in_array($product->shop_id, auth()->user()->shops->pluck('id')->toArray()) ) {
            $orderDetail->delete();
            return $this->jsonResponse('success', 'Order Variations Deleted.', request('redirectUrl')??url()->previous());
        }
        return $this->jsonResponse('error', 'You can delete only your oder detail.', request('redirectUrl')??url()->previous());
    }

    protected function prepareParams($request)
    {
        $time = date(' H:i:s');
        return [
            'customer_id' => $request->customer_id,
            'ordered_at' => $request->ordered_at? date('Y-m-d', strtotime($request->ordered_at)) . $time: null,
            'delivered_at' => $request->delivered_at? date('Y-m-d', strtotime($request->delivered_at)) . $time: null,
            'received_at' => $request->received_at? date('Y-m-d', strtotime($request->received_at)) . $time: null,
            'paid_at' => $request->paid_at? date('Y-m-d', strtotime($request->paid_at)) . $time: null,

            'total_amount' => $request->total_amount,
            'total_discount' => $request->total_discount,
            'status' => $request->status,
            'paid_status' => $request->paid_status,
            'payment_type_id' => $request->payment_type_id,
            'remark' => $request->remark,
            'deli_fee' => $request->deli_fee,
        ];
    }

}