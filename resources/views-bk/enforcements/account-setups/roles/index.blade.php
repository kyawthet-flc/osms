@extends('layouts.app')
@section('content')
<x-utils.card :attrs="['title' => 'Role']">

   <!-- <a href="{{ route('account_setup.roles.create') }}" class="btn btn-primary float-left mb-3">Add Office User</a> -->

    <x-utils.data-table :ths="['No', 'Name', 'Description', 'Action']">
        @foreach ($roles as $k => $role)
        <tr>
            <td>{{ $k+1 }}.</td>
            <td>{{ $role->name }}</td>
            <td>{{ $role->description }}</td>
            <td>
                <a href="{{ route('account_setup.roles.permissions.index', $role)}}" class="btn btn-sm btn-danger no-alert">
                Permission <i class='fa fa-lock'></i></a>       
            </td>
        </tr>
        @endforeach
    </x-utils.data-table>
</x-utils.card>
@endsection