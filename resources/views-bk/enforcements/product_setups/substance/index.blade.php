@extends('layouts.app')
@section('content')
    <x-utils.card :attrs="['title' => 'Substance']">

                <a href="{{ route('product_setup.substance.create') }}" class="btn btn-primary float-left mb-3">Add Substance</a>

        <x-utils.data-table :ths="['No', 'Name', 'Req Ba Be Status', 'Admitted Status', 'Cas No', 'Source Name','Reason', 'Product Type', 'Preferred Term', 'Controlled Sus', 'Status', 'Action']">
            @foreach ($result as $k => $data)
                <tr>
                    <td>{{ $k+1 }}</td>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->req_ba_be_status }}</td>
                    <td>{{ $data->admitted_status }}</td>
                    <td>{{ $data->cas_no }}</td>
                    <td>{{ $data->source_name }}</td>
                    <td>{{ $data->reason }}</td>
                    <td>{{ $data->product_type_id }}</td>
                    <td>{{ $data->preferred_term }}</td>
                    <td>{{ $data->controlled_sus }}</td>
                    <td>{{ $data->status }}</td>
                    <td>
                        <a href="{{ route('product_setup.substance.edit',[$data->id]) }}" class="btn btn-sm btn-warning btn_edit" data-id="{{$data->id}}">
                            Edit <i class='fa fa-pencil'></i>
                        </a>
                        <form action="{{ route('product_setup.substance.destroy', $data->id) }}" method="post" style="display: inline;">
                            @method('delete')
                            @csrf
                            <button class="btn btn-sm btn-danger no-alert btn_delete" type="button">
                                Delete <i class='fa fa-trash'></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </x-utils.data-table>
    </x-utils.card>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
           $('.btn_delete').on('click', function() {
               Swal.fire({
                   title: 'Are you sure?',
                   text: "You won't be able to revert this!",
                   icon: 'warning',
                   showCancelButton: true,
                   confirmButtonColor: '#3085d6',
                   cancelButtonColor: '#6c757d',
                   confirmButtonText: 'Yes!'
               }).then((result) => {
                   if (result.isConfirmed) {
                       $(this).parent('form').submit();
                   }
               })
           });
        });
    </script>
@endsection
