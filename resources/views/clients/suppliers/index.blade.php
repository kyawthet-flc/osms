<!-- PAGENO: OSMS-013 -->
@extends('layouts.app')
@section('content')
<x-utils.card :attrs="['title' => 'List']">
    <x-utils.data-table :ths="[
        'No.', 'Name', 'Phone/ E-mail', 'Address',  'City/District/Division or State', 'Action']">
        @foreach ($lists as $k => $list)
        <tr>
            <td>{{ $k+1 }}.</td>
            <td>{{ $list->name }}</td>
            <td>{{ $list->phone }} - {{ $list->email?? 'N\A'}}</td>
            <td>{!! $list->address !!}</td>
            <td>{!! $list->full_address !!}</td>
            <td>
              <a class="btn btn-sm mt-1 btn-outline-warning" href="{{ route('supplier.edit', ['supplier' => $list, 'redirectUrl' => current_url() ]) }}">
                <i class="mdi mdi-pencil-box"></i>Edit
              </a><br/>
              <a class="btn mt-1 btn-sm btn-outline-danger" 
                  del-attr="delete-item" 
                  confirmationText="Are you sure to delete?"
                  del-redirect-url="{{ url()->current() }}"
                  href="{{ route('supplier.delete', ['supplier' => $list, 'redirectUrl' => current_url() ]) }}">
                <i class="mdi mdi-delete"></i>Delete
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