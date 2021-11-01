<!-- PAGENO: OSMS-028 -->
<x-utils.card :attrs="['title' => 'New Product Supplyment', 'backUrl' => request('redirectUrl') ]">
    <div class="row justify-content-center pt-3 pb-5">
        <div class="col-md-6">
            @include('clients.products.product-supplyments._form',['action' => route('product.product_supplyment.store'), 'method' => 'post', 'submitLabel' => 'Create', 'confirmationText' => 'Are you sure to create?' ])
        </div>
    </div>  
</x-utils.card>