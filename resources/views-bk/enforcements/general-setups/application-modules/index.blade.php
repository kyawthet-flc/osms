@extends('layouts.app')
@section('content')
<x-utils.card :attrs="['title' => 'Application Modules']">

    <x-utils.data-table :ths="['No.', 'Code', 'Name', 'Status', 'Action']">
        @foreach ($lists as $k => $list)
        <tr>
            <td>{{ $k+1 }}.</td>
            <td>{{ $list->code }}</td>
            <td>{{ $list->name }}</td>
            <td>{{ $list->status }}</td>
            <td>
                <a href="{{ route('general_setup.applicationModules.edit', $list)}}" class="btn btn-sm btn-warning">
                Edit <i class='fa fa-pencil'></i>
                </a>
            </td>
        </tr>
        @endforeach
    </x-utils.data-table>
</x-utils.card>
@endsection