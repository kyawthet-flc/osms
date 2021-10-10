@foreach ($application->dlmcPaymentRecords as $dlmcPaymentRecord)
    <div class="row mb-2">
        <div class="col-md-3 mb-2">
            @if ($dlmcPaymentRecord->fee_name == 'Banking Service Fee')
                {{ $dlmcPaymentRecord->fee_name }}
            @elseif ($dlmcPaymentRecord->fee_name == 'Registration Fee')
                Final Payment
            @else
                Initial Fee
            @endif
        </div>
        <div class="col-md-9 mb-2">{{ $dlmcPaymentRecord->amount }}</div>
    </div>
@endforeach
