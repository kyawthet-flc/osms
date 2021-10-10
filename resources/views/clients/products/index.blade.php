<!-- PAGENO: OSMS-006 -->
@extends('layouts.app')
@section('content')
<x-utils.card :attrs="['title' => 'List']">
    <x-utils.data-table :ths="['No.', 'Shop', 'Selling Date', 'Product Name','Product Category', 'Variants', 'Status', 'Action',]">
        @foreach ($lists as $k => $list)
        <tr>
            <td>{{ $k+1 }}.</td>
            <td>{{ $list->shop->name }}</td>
            <td>{{ $list->selling_at }}</td>
            <td>{{ $list->name }}</td>
            <td>{{ $list->productType->name?? '' }}</td>
            <td>
                {{ $list->total_sub_product }} <br/><br/>                
                <a href="{{ route('product.sub_product.list', ['sku' => $list->sku]) }}">
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
</x-utils.card>
@endsection