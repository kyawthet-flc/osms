
<x-utils.card :attrs="['title' => 'Edit Product Supplyment', 'backUrl' =>request('redirectUrl') ]">
    <div class="row justify-content-center pt-3 pb-5">
        <div class="col-md-9">
            @include('clients.products.product-supplyments.form',[
                'action' => route('product.product_supplyment.update', $productSupplyment), 
                'method' => 'put', 
                'submitLabel' => 'Update', 
                'confirmationText' => 'Are you sure to update?' 
            ])
        </div>
    </div>  
</x-utils.card>