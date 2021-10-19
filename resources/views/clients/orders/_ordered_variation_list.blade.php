<!-- PAGENO: OSMS-025 -->
<div class="col-md-12 pt-3 pb-3">
<div class="row table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No.</th>
                <th>Size</th>
                <th>Color</th>
                <th>Quantity * Price</th>
                <th>Amount</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($listedVariations->groupBy('product_id') as $productId => $variations)
            <tr>
                <td colspan="6">Product Name - <b>{{ isset($products[$productId])? $products[$productId]: '' }}</b></td>
            </tr>
            @foreach($variations as $k => $listedVariation)
            <tr>
                <td>{{ $k + 1 }}.</td>
                <td>{{ $listedVariation->subProduct->size }}</td>
                <td>{{ $listedVariation->subProduct->color }}</td>
                <td>{{ $listedVariation->quantity }} * {{ $listedVariation->subProduct->price_sold }}</td>
                <td>{{ $listedVariation->sub_total_price }}</td>
                <td>
                    <a class="btn btn-danger btn-sm" del-attr="delete-item" 
                    confirmationText="Are you sure to delete?" href="{{ route('order.delete_product_variations',[
                        'order' => $listedVariation->order_id,
                        'orderDetail' => $listedVariation->id,
                        'product' => $listedVariation->product_id,
                        'subProduct' => $listedVariation->sub_product_id,
                        'quantity' => $listedVariation->quantity,
                    ]) }}" del-redirect-url="{{ url()->full() }}">X</a>
                </td>
            </tr>
            @endforeach
            @endforeach 
            <tr>
                <td colspan="6" style="text-align: center;">Total Price - {{ $order->total_amount }} + {{ $order->deli_fee?? 0 }}(Delivery Fee) = <b>{{ $order->total_amount + ($order->deli_fee?? 0) }}</b></td>
            </tr>
        </tbody>
    </table>
</div>
</div>