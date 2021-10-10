@extends('layouts.app')
@section('title') DIAC Budget Report @endsection

@section('content')

<x-utils.card :attrs="['title' => 'DIAC Budget Report']">

  @include('enforcements.tasks.reports.diac.budget-search-form')

  <div class="table-responsive">
    <table class="table table-bordered table-bordered">     
     <thead>
       <tr>
         <th style="width: 50px;">No.</th>         
         <th style="width: 130px;">Application No.</th>
         <th style="width: 140px;">Certificate No.</th>
         <th style="width: 100px;">Application Date</th>
         <th style="width: 120px;">Company Name</th>
         <th style="width: 170px;">Generic Name</th>
         <th style="width: 170px;">Brand Name</th>
         <th style="width: 170px;">Amount</th>
         <th style="width: 100px;">Application Type</th>
         <th style="width: 100px;">Application Status</th>
       </tr>       
     </thead>
     <tbody>
      @php
        $lists->load(['diacActionRecord', 'drugsToBeImported', 'diacPaymentRecords']);
        $indexer = $lists->perPage() * $lists->currentPage() - $lists->perPage();
      @endphp
      @foreach ($lists as $k => $list)
      <tr>
           <td class="text-center">{{ ($k + $indexer +1) }}.</td>
          <td>{{ $list->application_no }}</td>
          <td>{{ $list->certificate_no }}</td>
          <td>{{ optional($list->diacActionRecord)->submitted_at }}</td>
          <td>{{ $list->business_name }}</td>
          <td>{{ $list->drugsToBeImported->sortDesc()->first()->generic_name }}</td>
          <td>{{ $list->drugsToBeImported->sortDesc()->first()->brand_name }}</td>
          <td>1000</td>
          <td>{{ $list->application_type }}</td>
          <td>{{ $list->application_status }}</td>
      </tr>
      @endforeach     
    </tbody>
  </table>

</div>
{{ $lists->appends(request()->all()) }}

</x-utils.card>
@endsection