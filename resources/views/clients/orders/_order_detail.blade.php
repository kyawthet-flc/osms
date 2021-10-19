<div class="row mt-1 mb-1 p-1 pt-3 pb-2" style="border:1px solid #d0d0d0;">
    <div class="col-md-12">
        <p>Name: <b>{{ $customer->name }}</b></p>
        <p>E-mail: <b>{{ $customer->email }}</b></p>
        <p>Phone: <b>{{ $customer->phone }}</b></p>
        <p>Address: <b>{{ $customer->address }}</b></p>
        <p>City/ District/ Division: <b>{{ $customer->full_address }}</b></p>
    </div>
    <div class="col-md-12">
        <p>Amount: <b>{{ $order->total_amount }}</b>(+Delivery Fee: <b>{{ $order->deli_fee }}</b>)</p>
        <p>Total Amount: <b>{{ ($order->total_amount??0) + ($order->deli_fee??0)}}</b></p>
        <p>Payment Method: <b>{{  $paymentTypes[$order->payment_type_id]?? 'NA' }}</b>({{ $order->paid_status }})</p>
        <p>Payment Date: <b>{{ $order->paid_at? $order->paid_at->format('d-m-Y'): '' }}</b></p>
       
        <p>Order Date: <b>{{ $order->ordered_at? $order->ordered_at->format('d-m-Y'): '' }}</b></p>
        <p>Delivered Date: <b>{{ $order->delivered_at? $order->delivered_at->format('d-m-Y'): '' }}</b></p>
        <p>Customer Received Date: <b>{{ $order->received_at? $order->received_at->format('d-m-Y'): '' }}</b></p>
    </div>
</div>

<div class="row mt-1 mb-1 p-1" style="border:1px solid #d0d0d0;">
    <div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No.</th>
                <th>Product Name</th>
                <th>Size/ Color</th>
                <th>Quantity * Price</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
          
            @foreach($listedVariations as $k => $listedVariation)
            <tr>
                <td>{{ $k + 1 }}.</td>
                <td>{{ $listedVariation->product->name }}</td>
                <td>{{ $listedVariation->subProduct->size }}/ {{ $listedVariation->subProduct->color }}</td>
                <td>{{ $listedVariation->quantity }} * {{ $listedVariation->subProduct->price_sold }}</td>
                <td>{{ $listedVariation->sub_total_price }}</td>                
            </tr>
            @endforeach
            <tr>
                <td colspan="6" style="text-align: center;">Total Price - {{ $order->total_amount }} + {{ $order->deli_fee?? 0 }}(Delivery Fee) = <b>{{ $order->total_amount + ($order->deli_fee?? 0) }}</b></td>
            </tr>
        </tbody>
    </table>
    </div>
</div>