@foreach($application->onetimePaymentRecords as $onetimePaymentRecord)
 <h4 class="mb-1">
     {{ $onetimePaymentRecord->fee_name }} - 
     {{ $onetimePaymentRecord->amount }}
     <i>({{ $onetimePaymentRecord->created_at->format('Y-m-d') }})</i></h4>
@endforeach