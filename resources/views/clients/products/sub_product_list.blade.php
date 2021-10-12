<!-- PAGENO: OSMS-011 -->
@extends('layouts.app')
@section('content')
<x-utils.card :attrs="['title' => '<b>'.$product->name.'</b> - Product Variations', 'backUrl' => (request('redirectUrl')?? route('product.index')) ]">
    <div class="row justify-content-center pt-3 pb-5">
        
    {{--  <div class="col-md-12 mb-3">
            <button class="btn btn-success" data-micromodal-trigger data-custom-open="modal-1">
            <i class="mdi mdi-plus-circle"></i> Add New Variation
            </button>
        </div>
        <div class="col-md-12 sub-product-form-wrapper mb-3">
            @include('clients.products._sub_product_form',[
                'action' => route('product.sub_product.store',['sku' => $product->sku]), 
                'method' => 'post', 
                'submitLabel' => 'Create', 
                'confirmationText' => 'Are you sure to create?' 
        </div> 
        --}}
        <div class="col-md-12 mb-3">
            <a class="btn btn-success"  href="{{ route('product.get_sub_product_form', 
                ['sku' => $product->sku, 'redirectUrl' => current_url() ]) }}" edit-attr="edit-sub-product"
                 confirmationText="Are you sure to create?" 
                 data-micromodal-trigger="modal-1">
            <i class="mdi mdi-plus-circle"></i> Add New Variation
            </a>
        </div>
        <div class="col-md-12 sub-product-form-wrapper mb-3">
          
        </div>
<!--
    "product_id" => 1
    "sub_sku" => ""
    "color" => "a"
    "size" => "a"
    "quantity_bought" => 10
    "quantity_avaiable" => 10
    "quantity_left" => 0
    "unit" => "items"

    "price_bought" => 10000
    "price_original" => 0
    "price_sold" => 15000
    "currency" => 0
    "is_sold_out" => "no"
    "desc" => "Fugit ad magnam ali"
-->
       <div class="col-md-12">
        <x-utils.data-table :ths="[
            'No.',
            'Sub SKU', 
           'Size', 
           'Color', 
           'Bought/ Avaiable(Quantity) - Unit', 
           'Price Bought/ Price Sold',
           'Action',
        ]">
        @foreach ($subProducts as $k => $list)
        <tr>
            <td>{{ $k+1 }}.</td>
            <td>{{ $list->sub_sku }}</td>
            <td>{{ $list->size }}</td>
            <td>{{ $list->color }}</td>
            <td>
            {{ $list->quantity_bought }}/ {{ $list->quantity_avaiable }} - {{ $list->unit }}
            </td>
            <td>{{ $list->price_bought }}/ {{ $list->price_sold }}</td>
            <td>
              <a class="btn btn-sm btn-outline-warning" data-micromodal-trigger="modal-1" href="{{ route('product.get_sub_product_form', 
                ['sku' => $list->product->sku, 'subProduct' => $list, 'redirectUrl' => current_url()]) }}" edit-attr="edit-sub-product" data-micromodal-trigger="#"  confirmationText="Are you sure to edit?">
                <i class="mdi mdi-pencil-box"></i>Edit
              </a><br/>
              <a class="btn mt-1 btn-sm btn-outline-danger" 
                  del-attr="delete-item" 
                  confirmationText="Are you sure to delete?"
                  del-redirect-url="{{ url()->current() }}"
                  href="{{ route('product.sub_product.delete', ['subProduct' => $list, 'redirectUrl' => current_url() ]) }}">
                <i class="mdi mdi-delete"></i>Delete
              </a>
            </td>
        </tr>
        @endforeach
    </x-utils.data-table>
        </div>

    </div>  
</x-utils.card>
@endsection