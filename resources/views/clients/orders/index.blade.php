@extends('layouts.app')
@section('content')
<x-utils.card :attrs="['title' => 'List']">
    <x-utils.data-table :ths="['No.', 'Name', 'Role','Login ID', 'Email', 'Status', 'Action']">
        @foreach ([1, 2, 3,] as $k => $adminUser)
        <tr>
            <td>{{ $k+1 }}.</td>
            <td>{{ optional($adminUser)->name }}</td>
            <td>{{ optional($adminUser)->name?? '' }}</td>
            <td>{{ optional($adminUser)->login_id }}</td>
            <td>{{ optional($adminUser)->email }}</td>
            <td>{{ optional($adminUser)->status }}</td>
            <td>
              Edit    
            </td>
        </tr>
        @endforeach
    </x-utils.data-table>
</x-utils.card>
@endsection