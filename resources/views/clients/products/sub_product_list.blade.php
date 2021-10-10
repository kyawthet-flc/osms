<!-- PAGENO: OSMS-011 -->
@extends('layouts.app')
@section('content')
<x-utils.card :attrs="['title' => '<b>'.$product->name.'</b> - Product Variations', 'backUrl' => (request('redirectUrl')?? route('product.index')) ]">
    <div class="row justify-content-center pt-3 pb-5">
        
        <div class="col-md-12 mb-3">
            <button class="btn btn-success" data-custom-open="modal-1">
            <i class="mdi mdi-plus-circle"></i> Add New Variation
            </button>
        </div>

        @include('clients.products._sub_product_form',[
            'action' => route('product.sub_product.store',['sku' => $product->sku]), 'method' => 'post', 'submitLabel' => 'Create', 'confirmationText' => 'Are you sure to create?' ])

       <div class="col-md-12">
        <x-utils.data-table :ths="['No.', 'Shop', 'Selling Date', 'Product Name','Product Category', 'Variants', 'Status', 'Action',]">
        @foreach ($subProducts as $k => $list)
        <tr>
            <td>{{ $k+1 }}.</td>
            <td>{{ $list->shop->name }}</td>
            <td>{{ $list->selling_at }}</td>
            <td>{{ $list->name }}</td>
            <td>{{ $list->productType->name?? '' }}</td>
            <td>
                {{ $list->total_sub_product }} <br/><br/>                
                <a href="{{ route('product.sub_product.create', ['sku' => $list->sku]) }}">
                    <i class="mdi mdi-pencil-box"></i>{{ $list->total_sub_product === 0? 'Add': 'Add/ View '}} Product Variations
                </a>
            </td>
            <td>{{ $list->status }}</td>
            <td>
              <a class="btn btn-sm btn-outline-warning" href="{{ route('product.edit', ['product' => $list, 'redirectUrl' => current_url() ]) }}">
                <i class="mdi mdi-pencil-box"></i>Edit
              </a><br/>
              <a class="btn mt-1 btn-sm btn-outline-danger" 
                  del-attr="delete-item" 
                  confirmationText="Are you sure to delete?"
                  del-redirect-url="{{ url()->current() }}"
                  href="{{ route('product.delete', ['product' => $list, 'redirectUrl' => current_url() ]) }}">
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