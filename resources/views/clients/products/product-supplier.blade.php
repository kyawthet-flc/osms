<div class="row p-1">
    <div class="col-md-12">
        <label for=""><b>Product Suppliers' Info</b></label>
        <a ajax-type="supplier-form" class="text-success" href="{{ route('product.product_supplyment.create',['productId' => $product->id ]) }}">
            <i class="mdi mdi-plus-box"></i>
        </a> 
    </div>
    @php
        $product->productSupplyments->load(['supplier', 'supplier.division', 'supplier.district', 'supplier.township'])
    @endphp
    @foreach($product->productSupplyments as $k => $psupplyment)
    <div class="col-md-12 mt-1">
        <h5>
            {{ $k + 1}}. {{ $psupplyment->supplier->name }}
            
            <a class="text-warning" ajax-type="supplier-form" href="{{ route('product.product_supplyment.edit', $psupplyment) }}">
                <i class="mdi mdi-pencil-box"></i>
            </a>

            <a class="text-danger" 
            del-attr="delete-item" 
            confirmationText="Are you sure to delete?"
            del-redirect-url="{{ url()->current() }}"
            href="{{ route('product.product_supplyment.delete', ['productSupplyment' => $psupplyment, 'redirectUrl' => current_url() ]) }}"
            >
                <i class="mdi mdi-delete-circle"></i>
            </a>
        </h5>
        <p style="font-size: 10px;">{{ $psupplyment->supplier->full_address }}</p>
        <h6>Total Amount: {{ $psupplyment->total_amount }}</h6>
        <h6>Paid Amount: {{ $psupplyment->paid_amount }}</h6>
        <h6>Remaining Amount: {{ $psupplyment->remaining_amount }}</h6>
        <hr>
        <p style="font-size: 12px;">. {{ $psupplyment->remark }}</p>
    </div>
    @endforeach
</div>