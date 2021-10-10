@extends('layouts.app')
@section('content')
<x-utils.card :attrs="['title' => 'Onetime Purposes']">
    
<a href="{{ route('general_setup.onetimePurposes.create') }}" class="btn btn-primary float-left mb-3">Add Onetime Purpose</a>


    <table class="table table-bordered">
        <thead>
          <th style="width: 70px;">No.</th>
          <th>Name</th>
          <th>Description</th>
          <th>Action</th>
        </thead>
        <tbody>
          @php
              $indexer = $lists->perPage() * $lists->currentPage() - $lists->perPage();
          @endphp
          @foreach ($lists as $k => $list)
          <tr class="fee-display-wrapper">
            <td>{{ $indexer + $k+1 }}.</td>
            <td>{{ $list->name }}</td>
            <td>{{ $list->description }}</td>
            <td>
              <form action="{{ route('general_setup.onetimePurposes.destroy', $list) }}" method="POST">
                @csrf
                @method('DELETE')
                <a href="{{ route('general_setup.onetimePurposes.edit', $list) }}" class="btn btn-info">Edit</a>


                <button class="btn btn-danger">Delete</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

      <div class="row">
        <div class="col-md-12">
          {{ $lists->appends([])->links() }}
        </div>
      </div>

</x-utils.card>
@endsection