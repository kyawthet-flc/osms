@extends('layouts.app')
@section('content')
<x-utils.card :attrs="['title' => 'Office Users']">

   <a href="{{ route('account_setup.adminUsers.create') }}" class="btn btn-primary float-left mb-3">Add Office User</a>

    <x-utils.data-table :ths="['No.', 'Name', 'Role','Login ID', 'Email', 'Status', 'Action']">
        @foreach ($adminUsers as $k => $adminUser)
        <tr>
            <td>{{ $k+1 }}.</td>
            <td>{{ $adminUser->name }}</td>
            <td>{{ $adminUser->roles()->first()->name?? '' }}</td>
            <td>{{ $adminUser->login_id }}</td>
            <td>{{ $adminUser->email }}</td>
            <td>{{ $adminUser->status }}</td>
            <td>
                <a href="{{ route('account_setup.adminUsers.edit', $adminUser)}}" class="btn btn-sm btn-warning">
                Edit <i class='fa fa-pencil'></i>
                </a>
                <a href="{{ route('account_setup.adminUsers.permissions.index', $adminUser)}}" class="btn btn-sm btn-danger no-alert">
                Permission <i class='fa fa-lock'></i></a>        
            </td>
        </tr>
        @endforeach
    </x-utils.data-table>
</x-utils.card>
@endsection