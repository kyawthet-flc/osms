@extends('layouts.app')
@section('content')
<x-utils.card :attrs="['title' => 'Application Document']">

    <a href="{{ route('general_setup.documents.create') }}" class="btn btn-primary float-left">Create</a><br><br>
 
    <table class="table table-bordered">
        <thead>
          <th style="width: 70px;">No.</th>
          <th>File Code</th>
          <th>File Name</th>
          <th>File Type</th>
          <th>MIME Type</th>
          <th>Uploadable File Count</th>
          <th>Require</th>
          <th>Require If</th>
          <th>Status</th>
          <th>Action</th>
        </thead>
        <tbody>
          @foreach ($lists as $k => $list)
          <tr @if($list->status==='deleted') style="background-color: #d16666;color: #fafafa;" @endif>
            <td>{{ $k+1 }}.</td>
            <td>{{ $list->file_code }}</td>
            <td>{{ $list->file_name }}</td>
            <td>{{ $list->file_type }}</td>
            <td>{{ $list->mimes }}</td>
            <td>{{ $list->uploadable_file_count }}</td>
            <td>{{ $list->require }}</td>
            <td>{{ $list->require_if }}</td>
            <td>{{ $list->status }}</td>
            <td>
              <a href="{{ route('general_setup.documents.edit', $list) }}">Edit</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

</x-utils.card>
@endsection