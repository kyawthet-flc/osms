<!-- PAGENO: OSMS-001 -->
@extends('layouts.app')
@section('content')
<x-utils.card :attrs="['title' => 'List']">
    <x-utils.data-table :ths="[
        'No.', 'Name', 'phone', 'Status', 'Action']">
        @foreach ($lists as $k => $list)
        <tr>
            <td>{{ $k+1 }}.</td>
            <td>{{ $list->name }} {!! $list->name_mm? '<br/>('.$list->name_mm.')' : '' !!}</td>
            <td>{{ $list->phone }}</td>
            <td>{{ $list->status }}</td>
            <td>
              <a class="btn btn-sm btn-outline-warning" href="{{ route('shop.edit', ['shop' => $list, 'redirectUrl' => current_url() ]) }}">
                <i class="mdi mdi-pencil-box"></i>
              </a><br/>
              <a class="btn mt-1 btn-sm btn-outline-danger" 
                  del-attr="delete-item" 
                  confirmationText="Are you sure to delete?"
                  del-redirect-url="{{ url()->current() }}"
                  href="{{ route('shop.delete', ['shop' => $list, 'redirectUrl' => current_url() ]) }}">
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