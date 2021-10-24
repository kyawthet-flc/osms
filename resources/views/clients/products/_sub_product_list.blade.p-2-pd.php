<div class="row mt-1 mb-1 p-1 pt-3 pb-2" style="border:1px solid #d0d0d0;">
<div class="col-md-12 table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No.</th>
                <th>Size/ Color</th>
                <th>Avai Qty</th>
                <th>Left Qty</th>
                <th>Bought Price</th>
                <th>Sold Price</th>
                <!-- <th>Total Selling Amount</th> -->
                <th>Total Sold Amount</th>
                <th>Total Profit</th>
            </tr>
        </thead>
        <tbody>
            @php 
             $product->load(['subProducts', 'subProducts.orderDetails']);
             $totalSellingAmount = 0;
             $totalBoughtAmount = 0;
             $totalDeliveryAmount = 0;
            @endphp
            @foreach($product->subProducts as $k => $subProduct)
            <tr>
                <td>{{ $k + 1 }}.</td>
                <td>{{ $subProduct->size }}/ {{ $subProduct->color }}</td>
                <td>{{ $subProduct->quantity_avaiable }}</td>
                <td>{{ $subProduct->quantity_left }}</td>
                <td>{{ $subProduct->price_original }}</td>
                <td>{{($subProduct->quantity_avaiable - $subProduct->quantity_left) }}*{{ $subProduct->price_sold }}</td>
                <td>{{ ($subProduct->quantity_avaiable - $subProduct->quantity_left) * $subProduct->price_sold }}</td>
                <!-- <td>{{ $subProduct->orderDetails->sum('sub_total_price') }}</td> -->
                <td>{{ $subProduct->orderDetails->sum('sub_total_price') - ($subProduct->price_original * $subProduct->quantity_avaiable) }}</td>
                @php
                  $totalSellingAmount += $subProduct->orderDetails->sum('sub_total_price');
                  $totalBoughtAmount += $subProduct->price_original * $subProduct->quantity_avaiable;
                  $totalDeliveryAmount += 0;
                @endphp
                
            </tr>
            @endforeach
          
        </tbody>
    </table>

</div>
</div>