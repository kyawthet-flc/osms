@extends('layouts.app')
@section('title') DLMC Budget Report @endsection

@section('content')

<x-utils.card :attrs="['title' => 'DLMC Budget Report']">

  @include('enforcements.tasks.reports.dlmc.budget-search-form')

  <div class="table-responsive">
    <table class="table table-bordered table-bordered">     
     <thead>
       <tr>
         <th style="width: 50px;">No.</th>         
         <th style="width: 130px;">Application No.</th>
         <th style="width: 140px;">Certificate No.</th>
         <th style="width: 100px;">Application Date</th>
         <th style="width: 120px;">Factory Name</th>
         <th style="width: 170px;">Dosage Form Type</th>
         <th style="width: 170px;">Amount</th>
         <th style="width: 100px;">Application Type</th>
         <th style="width: 100px;">Application Status</th>
       </tr>       
     </thead>
     <tbody>
      @php
        $lists->load(['dlmcActionRecord', 'dlmcDrugsToProduces', 'dlmcPaymentRecords']);
        $indexer = $lists->perPage() * $lists->currentPage() - $lists->perPage();
      @endphp
      @foreach ($lists as $k => $list)
      <tr>
           <td class="text-center">{{ ($k + $indexer +1) }}.</td>
          <td>{{ $list->application_no }}</td>
          <td>{{ $list->certificate_no ?? 'N/A' }}</td>
          <td>{{ optional($list->dlmcActionRecord)->submitted_at }}</td>
          <td>{{ $list->manufacturer_name }}</td>
          <td>
            {{ $list->dlmcDrugsToProduce->dosage_type?? 'N\A' }}
          </td>
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