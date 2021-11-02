<!-- PAGENO: OSMS-012 -->
<div class="col-md-12 pt-5">
    <div class="row">
        <div class="col-md-12">
            @foreach($sizes as $size)
            <label for="{{ $size }}" class="mr-3 p-1 pl-2 pr-2">
                <input type="radio"
                   @if($selectedSize==$size) checked="checked" @endif 
                   name="selected_size" value="{{ $size }}" id="{{ $size }}" 
                   href="{{ route('product.sub_product.variation_form_by_size',['sku' => $product->sku, 'subProduct' => $subProduct, 'selected_size' => $size]) }}" />&nbsp;<b>{{ $size }}</b>
            </label>
            @endforeach
        </div>
    </div>
    <div class="row product-variation-form-loader-text text-center p-5 pt-1" style="display: @if($selectedSize) none @else block @endif">
        <div class="col-md-12"><b>Please select size.</b></div>
    </div>
    <div class="row product-variation-form-wrapper">
        @if($selectedSize)
            @include('clients.products.variation-form-by-size')
        @endif
    </div>
</div>