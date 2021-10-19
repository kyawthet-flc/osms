<!-- PAGENO: OSMS-024 -->
<div class="col-md-12 product-variation-wrapper" style="min-height: 10px;height: auto;padding: 0;background-color: transparent;padding: 20px 5px 0;border-top:1px solid #dedede;">
<div class="row">
    <label class="col-md-12">Product Variation(s)</label>
    <input type="hidden" name="code" value="{{ $code }}" />
    
    <div class="col-md-12 mb-3 product-variation" id="product-variation"> 
        <div class="row p-2">
        <div class="col-md-2">
            <label style="font-size: 11px;"><b>Size</b></label><br/>
            <select class="form-control order-product-id" name="product_id" 
            onchange="window.location.href='{{ url()->current() }}?code={{ $code }}&customer_id={{ request('customer_id') }}&product_id='+this.value+'#product-variation'">
                <option value="">Choose Product</option>
                @foreach($products as $key => $val)
                <option value="{{ $key }}" @if(request('product_id', $order->product_id)== $key) selected="selected" @endif >{{ $val }}</option>
                @endforeach
            </select>
            
        </div>
            @if( request('product_id') )
            <div class="col-md-2">
                <input type="hidden" name="sub_product_id" value="" class="form-control" />
                <label style="font-size: 11px;"><b>Size</b></label><br/>
                <select class="form-control" name="size" id="">
                    <option value="">Please Select</option>
                    @foreach(App\Model\Client\Product::find(request('product_id', 0))->subProducts->groupBy('size')??[] as $size => $data)
                    <option value="{{ $size }}" color-relation="{{ json_encode($data->keyBy('color')) }}">{{ $size }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label style="font-size: 11px;"><b>Color</b></label><br/>
                <select class="form-control" name="color" id="" disabled="disabled">
                </select>
            </div>
            <div class="col-md-2">
                <label style="font-size: 11px;"><b>Quantity</b></label><br/>
                <input type="text" name="quantity" class="form-control" disabled="disabled" />
            </div>
            <div class="col-md-2">
                <label style="font-size: 11px;"><b>Avaiable Item</b></label><br/>
                <span style="font-size: 11px;" class="quantity-counter">0</span>
            </div>
            <div class="col-md-2" style="padding-top: 33px;">
                <button redirect-url="{{ url()->full() }}" class="save-product-variation btn btn-primary btn-sm">Add</button>
            </div>
            @endif
        </div>
    </div> <!-- product-variations -->
</div>
</div>