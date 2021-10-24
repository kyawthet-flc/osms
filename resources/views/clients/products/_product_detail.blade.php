<div class="row mt-1 mb-1 p-1 pt-3 pb-2" style="border:1px solid #d0d0d0;">
<div class="col-md-12">
    <p><span>Status</span>: <b>{{ remove_dash($product->status) }}</b></p>
    <p><span>Name</span>: <b>{{ $product->name }}</b></p>
    <p><span>Total Product</span>: <b>{{ $product->total_sub_product }}</b></p>
    <p><span>Description</span>: <b>{{ $product->desc }}</b></p>
</div>
</div>

@include('clients.products._sub_product_list')