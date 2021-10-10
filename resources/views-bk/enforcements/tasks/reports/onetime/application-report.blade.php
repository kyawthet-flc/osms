@extends('layouts.app')
@section('title') Onetime Application Report @endsection

@section('content')

<x-utils.card :attrs="['title' => 'Onetime Application Report']">

  @include('enforcements.tasks.reports.onetime.application-search-form')

  <div class="table-responsive">
    <table class="table table-bordered table-bordered">     
     <thead>
       <tr>
         <th style="width: 50px;">No.</th>         
         <th style="width: 130px;">Application No.</th>
         <th style="width: 140px;">Certificate No.</th>
         <th style="width: 100px;">Application Date</th>
         <th style="width: 120px;">Importer Name</th>
         <th style="width: 170px;">Name Of Drug</th>
         <th style="width: 170px;">Brand Name</th>
         <th style="width: 100px;">Application Status</th>
       </tr>       
     </thead>
     <tbody>
      @php
        $lists->load(['onetimeActionRecord', 'onetimeProductLists']);
        $indexer = $lists->perPage() * $lists->currentPage() - $lists->perPage();
      @endphp
      @foreach ($lists as $k => $list)
      <tr>
           <td class="text-center">{{ ($k + $indexer +1) }}.</td>
          <td>{{ $list->application_no }}</td>
          <td>{{ $list->certificate_no }}</td>
          <td>{{ optional($list->onetimeActionRecord)->submitted_at }}</td>
          <td>{{ $list->importer_name }}</td>
          <td>{{ $list->onetimeProductLists->sortDesc()->first()->drug_name }}</td>
          <td>{{ $list->onetimeProductLists->sortDesc()->first()->brand_name }}</td>
          <td>{{ $list->application_status }}</td>
      </tr>
      @endforeach     
    </tbody>
  </table>

</div>
{{ $lists->appends(request()->all()) }}

</x-utils.card>
@endsection