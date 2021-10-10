@extends('layouts.app')
@section('content')
<x-utils.card :attrs="['title' => 'Dlmc Dosage Form']">
    
<a href="{{ route('general_setup.dlmcDosageForms.create') }}" class="btn btn-primary float-left mb-3">Add Dlmc Dosage Form</a>


    <table class="table table-bordered">
        <thead>
          <th style="width: 70px;">No.</th>
          <th>Parent ID</th>
          <th>Name</th>
          <th>type</th>
          <th>Action</th>
        </thead>
        <tbody>
          @php
              // $indexer = $lists->perPage() * $lists->currentPage() - $lists->perPage();
          @endphp
          @foreach ($lists as $k => $list)
          <tr class="fee-display-wrapper">
            <td>{{ $k+1 }}.</td>
            <td>{{ $list->parent_id??'N/A' }}</td>
            <td>{{ $list->name }}</td>
            <td>{{ $list->type??'N/A' }}</td>
            <td>
              @if ($list->parent_id)
                <a class="btn btn-warning mb-2" href="{{ route('general_setup.childDlmcDosageForms.edit', $list) }}">Edit Child</a>
                <form action="{{ route('general_setup.childDlmcDosageForms.destroy', $list) }}" method="POST">
                  @csrf
                  @method('DELETE')  
                  <button class="btn btn-danger">Delete</button>
                </form>
              @else
                <a class="btn btn-warning" href="{{ route('general_setup.dlmcDosageForms.edit', $list) }}">Edit</a>
                <a href="{{ route('general_setup.childDlmcDosageForms.create', $list) }}" class="btn btn-primary">Add Child</a>
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

      <div class="row">
        <div class="col-md-12">
          {{-- {{ $lists->appends([])->links() }} --}}
        </div>
      </div>

</x-utils.card>
@endsection