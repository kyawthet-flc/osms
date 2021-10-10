@foreach($application->diacPaymentRecords as $diacPaymentRecord)
 <h4 class="mb-1">
     {{ $diacPaymentRecord->fee_name }} - 
     {{ $diacPaymentRecord->amount }}
     <i>({{ $diacPaymentRecord->created_at->format('Y-m-d') }})</i></h4>
@endforeach