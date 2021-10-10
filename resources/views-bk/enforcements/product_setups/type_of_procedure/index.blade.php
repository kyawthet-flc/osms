@extends('layouts.app')
@section('content')
    <x-utils.card :attrs="['title' => 'Type Of Procedure']">

                <a href="{{ route('product_setup.type_of_procedure.create') }}" class="btn btn-primary float-left mb-3">Add New Type Of Procedure</a>

        <x-utils.data-table :ths="['No', 'Name', 'Description', 'Action']">
            @foreach ($result as $k => $data)
                <tr>
                    <td>{{ $k+1 }}</td>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->description }}</td>
                    <td>
                        <a href="{{ route('product_setup.type_of_procedure.edit',[$data->id]) }}" class="btn btn-sm btn-warning btn_edit" data-id="{{$data->id}}">
                            Edit <i class='fa fa-pencil'></i>
                        </a>
                        <form action="{{ route('product_setup.type_of_procedure.destroy', $data->id) }}" method="post" style="display: inline;">
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
                   title: 'Warning!',
                   text: "Are you sure want to delete this?",
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
