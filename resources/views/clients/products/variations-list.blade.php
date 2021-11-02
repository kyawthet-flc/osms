<!-- PAGENO: OSMS-011 -->
{{-- 'backUrl' => route('product.edit', $product). '#variation-list' --}}

<x-utils.card :attrs="['title' => '<b>Product Variations - ('.$product->subProducts()->count().')</b>' ]">
    <div class="row justify-content-center pt-3 pb-5">
        <div class="col-md-12 mb-3">
            <a class="btn btn-success"  href="{{ route('product.get_sub_product_form', 
                ['sku' => $product->sku, 'redirectUrl' => current_url() ]) }}" edit-attr="edit-sub-product"
                 confirmationText="Are you sure to create?" 
                 data-micromodal-trigger="modal-1">
            <i class="mdi mdi-plus-circle"></i> Add Variation
            </a>
        </div>

       <div class="col-md-12" id="product-variation-list">
        <x-utils.data-table :ths="[
           'No.',
           'Action',
           'Sub SKU', 
           'Size', 
           'Color', 
           'Bought/ Avaiable(Quantity) - Unit', 
           'Quantity Left', 
           'Price Bought/ Price Sold'
        ]">
        @foreach ($product->subProducts as $k => $list)
        <tr>
            <td>{{ $k+1 }}.</td>
            <td>
              <a class="btn btn-sm mt-1 btn-outline-warning" data-micromodal-trigger="modal-1" href="{{ route('product.get_sub_product_form', 
                ['sku' => $list->product->sku, 'subProduct' => $list, 'redirectUrl' => current_url()]) }}" edit-attr="edit-sub-product" data-micromodal-trigger="#"  confirmationText="Are you sure to edit?">
                <i class="mdi mdi-pencil-box"></i>
              </a><br/>
              <a class="btn mt-1 btn-sm btn-danger" 
                  del-attr="delete-item" 
                  confirmationText="Are you sure to delete?"
                  del-redirect-url="{{ url()->current() }}"
                  href="{{ route('product.sub_product.delete', ['subProduct' => $list, 'redirectUrl' => current_url() ]) }}">
                <i class="mdi mdi-delete"></i>
              </a>
            </td>
            <td>{{ str_pad($list->sub_sku, 4, 0, STR_PAD_LEFT) }}</td>
            <td>{{ $list->size }}</td>
            <td>{{ $list->color }}</td>
            <td>
            {{ $list->quantity_bought }}/ {{ $list->quantity_avaiable }} - {{ $list->unit }}
            </td>
            <td>{{ $list->quantity_left }}</td>
            <td>{{ $list->price_bought }}/ {{ $list->price_sold }}</td>
        </tr>
        @endforeach
    </x-utils.data-table>
        </div>

    </div>  
</x-utils.card>