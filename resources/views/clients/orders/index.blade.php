<!-- PAGENO: OSMS-018 -->
@extends('layouts.app')
@section('content')
<x-utils.card :attrs="['title' => 'List']">

    <x-utils.data-table :ths="[
        'No.', 
        'Tracking No.', 
        'Customer Name',
        'Total( Amount + Delivery Fee)',
        'Payment Status', 
        'Status',
        'Order Date',
        'Voucher',
        'Action'
      ]">
        @foreach ($lists as $k => $list)
        <tr>
            <td>{{ $k+1 }}.</td>
            <td>{!! $list->code !!}</td>
            <td>{!! $list->customer->name !!}<br/>Ph No. {!! $list->customer->phone !!}</td>
            <td>{{ $list->total_amount + $list->deli_fee }} ({!! $list->total_amount !!} + {{ $list->deli_fee }})</td>
            <td>{!! $list->paid_status !!}<br/>({{ $paymentTypes[$list->payment_type_id] }})</td>
            <td>{{ $list->status }}</td>
            <td>{!! $list->ordered_at !!}</td>
            <!-- <td>{!! $list->delivered_at !!}</td> -->
            <!-- <td>{!! $list->received_at !!}</td> -->
            <td>
              @if( $list->receipt_id)
              <a class="btn" href="{{ route('document.order.print',['order' => $list, 'type' => 'pdf']) }}"><i class="mdi mdi-file-pdf"></i>Reprint</a><br/>
              <a class="btn mt-1"  onclick="window.open('{{ route('document.order.download',['file' => $list->receipt_id, 'type' => 'pdf']) }}', '_blank', 'fullscreen=yes'); return false;"
               href="{{ route('document.order.download',['file' => $list->receipt_id, 'type' => 'pdf']) }}"><i class="mdi mdi-cloud-download"></i>Download</a>
              @else
              <a class="btn" href="{{ route('document.order.print',['order' => $list, 'type' => 'pdf']) }}"><i class="mdi mdi-file-pdf"></i>Print</a>
              @endif
            </td>
            <td> 
              <a class="btn btn-sm mt-1 btn-outline-success" view-attr="view-item" href="{{ route('order.show', ['order' => $list,'code' => $list->code, 'customer_id' => $list->customer_id ]) }}">
                <i class="mdi mdi-eye"></i>
              </a><br/>
              <a class="btn mt-1 btn-sm btn-outline-warning" href="{{ route('order.create', ['code' => $list->code, 'customer_id' => $list->customer_id ]) }}">
                <i class="mdi mdi-pencil-box"></i>
              </a><br/>
                <a class="btn mt-1 btn-sm btn-outline-danger" 
                  del-attr="delete-item" 
                  confirmationText="Are you sure to delete?"
                  del-redirect-url="{{ url()->full() }}"
                  href="{{ route('order.delete', ['order' => $list, 'redirectUrl' => current_url() ]) }}">
                <i class="mdi mdi-delete"></i>
              </a>

            </td>
        </tr>
        @endforeach
    </x-utils.data-table>
    <div class="row mt-3">
        <div class="col-md-12 d-flex justify-content-center">
            {{ $lists->appends(request()->all())->links() }}
        </div>
    </div>
</x-utils.card>
@endsection