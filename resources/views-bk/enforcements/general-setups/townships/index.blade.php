@extends('layouts.app')
@section('content')
<x-utils.card :attrs="['title' => 'Township']">
    
<a href="{{ route('general_setup.townships.create') }}" class="btn btn-primary float-left mb-3">Add Township</a>


    <table class="table table-bordered">
        <thead>
          <th style="width: 70px;">No.</th>
          <th>State/ Division</th>
          <th>District</th>
          <th>Name</th>
          <th>Name(in Myanmar)</th>
          <th>Action</th>
        </thead>
        <tbody>
          @php
              $lists->load(['district', 'district.division']);
              $indexer = $lists->perPage() * $lists->currentPage() - $lists->perPage();
          @endphp
          @foreach ($lists as $k => $list)
          <tr class="fee-display-wrapper">
            <td>{{ $indexer + $k+1 }}.</td>
            <td>{{ optional($list->district->division)->name }}</td>
            <td>{{ $list->district->name }}</td>
            <td>{{ $list->name }}</td>
            <td>{{ $list->name_mm }}</td>
            <td>
              <a href="{{ route('general_setup.townships.edit', $list) }}">Edit</a>
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