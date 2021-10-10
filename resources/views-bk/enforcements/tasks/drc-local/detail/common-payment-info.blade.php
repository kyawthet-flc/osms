@foreach($application->drcPaymentRecords as $drcPaymentRecord)
    <h4 class="mb-1">
        {{ $drcPaymentRecord->fee_name }} -
        {{ $drcPaymentRecord->amount }}
        <i>({{ $drcPaymentRecord->created_at->format('Y-m-d') }})</i></h4>
@endforeach
