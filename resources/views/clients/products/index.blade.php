<!-- PAGENO: OSMS-006 -->
@extends('layouts.app')
@section('content')
<x-utils.card :attrs="['title' => 'List']">

    <x-utils.data-table :ths="['No.', 'Product Name', 'Status','Total Quantity', 'Quantity Left', 'Action',]">
        @foreach ($lists as $k => $list)
        <tr>
            <td>{{ $k+1 }}.</td>
            <td>{{ $list->name }}<br>
            <span style="font-size: 10px;">- {{ $list->shop->name }}</span><br>
            <span style="font-size: 10px;">- {{ $list->productType->name?? '' }}</span>
           </td>
            <td>{{ remove_dash($list->status) }}</td>
            <td>{{ $list->total_sub_product }}</td>
            <td>{{ $list->subProducts->sum('quantity_left') }}</td>
            <td> <a class="btn btn-sm mt-1 btn-outline-success" loading-text="Getting Product Detail..." view-attr="get-ajax-view" href="{{ route('product.show', ['product' => $list, 'redirectUrl' => current_url() ]) }}">
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