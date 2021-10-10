<table class="table table-bordered table-bordered">     
     <thead>
       <tr>
         <th>No.</th>         
         <th>Application No.</th>
         <th>Certificate No.</th>
         <th>Application Date</th>
         <th>Company Name</th>
         <th>Generic Name</th>
         <th>Brand Name</th>
         <th>Application Type</th>
         <th>Application Status</th>
       </tr>       
     </thead>
     <tbody>
      @php
        $lists->load(['diacActionRecord', 'drugsToBeImported']);
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
          <td>{{ $list->application_type }}</td>
          <td>{{ $list->application_status }}</td>
      </tr>
      @endforeach     
    </tbody>
  </table>