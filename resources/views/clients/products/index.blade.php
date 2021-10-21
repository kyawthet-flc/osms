<!-- PAGENO: OSMS-006 -->
@extends('layouts.app')
@section('content')
<x-utils.card :attrs="['title' => 'List']">

    <x-utils.data-table :ths="['No.', 'Shop', 'Product Name', 'Product Detail', 'Quantity Left','Status', 'Action',]">
        @foreach ($lists as $k => $list)
        <tr>
            <td>{{ $k+1 }}.</td>
            <td>{{ $list->shop->name }}</td>
            <td>{{ $list->name }}({{ $list->productType->name?? '' }})</td>
            <td>
                {{ $list->total_sub_product }} <br/><br/>                
                <a href="{{ route('product.sub_product.list', ['sku' => $list->sku]) }}">
                    <i class="mdi mdi-pencil-box"></i>{{ $list->total_sub_product === 0? 'Add': 'Add/ View '}} Product Variations
                </a>
            </td>
            <td>{{ $list->subProducts->sum('quantity_left') }}</td>
            <td>{{ remove_dash($list->status) }}</td>
            <td> <a class="btn btn-sm btn-outline-success" view-attr="view-item" href="{{ route('product.show', ['product' => $list, 'redirectUrl' => current_url() ]) }}">
                <i class="mdi mdi-eye"></i>
              </a>
              <a class="btn btn-sm mt-1 btn-outline-warning" href="{{ route('product.edit', ['product' => $list, 'redirectUrl' => current_url() ]) }}">
                <i class="mdi mdi-pencil-box"></i>
              </a>
              <a class="btn mt-1 btn-sm btn-outline-danger" 
                  del-attr="delete-item" 
                  confirmationText="Are you sure to delete?"
                  del-redirect-url="{{ url()->current() }}"
                  href="{{ route('product.delete', ['product' => $list, 'redirectUrl' => current_url() ]) }}">
                <i class="mdi mdi-delete"></i>
              </a>
            </td>
        </tr>
        @endforeach
    </x-utils.data-table>
</x-utils.card>
@endsection