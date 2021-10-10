<div class="row">
    <div class="col-md-3">{{ __('Application Date') }}</div>
    <div class="col-md-9">{{ $application->diacActionRecord->submitted_at }}</div>
    <div class="col-md-3">{{ __('Application No.') }}</div>
    <div class="col-md-9">{{ $application->application_no }}</div>
</div>

@if( $application->certificate_no )
    <div class="row mt-2">
        <div class="col-md-3">{{ __('Certificate No.') }}</div>
        <div class="col-md-9">{{ $application->certificate_no }}</div>
        
        <div class="col-md-3">{{ __('Issue Date') }}</div>
        <div class="col-md-9">{{ $application->issue_date }}</div>

        <div class="col-md-3">{{ __('Expiry Date') }}</div>
        <div class="col-md-9">{{ $application->expire_date }}</div>
    </div>
@endif