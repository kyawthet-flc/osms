<div class="row">
    <div class="col-md-12">
        <b>Registration Fee Status: </b>
        @switch ($application->registration_fee)
        @case('pending')
            <span class="text-primary"><i class="fa fa-circle-o" aria-hidden="true"></i> Not Requested</span>
            @break
        @case('requested')
            <span class="text-info"><i class="fa fa-hand-paper-o" aria-hidden="true"></i> Requested </span>
            @break
        @case('paid')
            <span class="text-success"><i class="fa fa-check" aria-hidden="true"></i> Paid </span>
            @break
        @endswitch
    </div>
</div>
