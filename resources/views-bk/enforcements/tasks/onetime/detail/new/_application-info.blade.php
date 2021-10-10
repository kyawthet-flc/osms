<div class="row">
    <div class="col-md-3 font-weight-bold">{{ __('Application Date') }}</div>
    <div class="col-md-9">{{ $application->onetimeActionRecord->submitted_at }}</div>

    <div class="col-md-3 font-weight-bold">{{ __('Application No.') }}</div>
    <div class="col-md-9">{{ $application->application_no }}</div>
    <div class="col-md-3 font-weight-bold">{{ __('Type of Procedure.') }}</div>
    <div class="col-md-9">{{ $application->type_of_procedure }}</div>
</div>

@if( $application->certificate_no )
    <div class="row mt-2">
        <div class="col-md-3 font-weight-bold">{{ __('Certificate No.') }}</div>
        <div class="col-md-9">{{ $application->certificate_no }}</div>
        
        <div class="col-md-3 font-weight-bold">{{ __('Issue Date') }}</div>
        <div class="col-md-9">{{ $application->issue_date }}</div>

        <div class="col-md-3 font-weight-bold">{{ __('Expiry Date') }}</div>
        <div class="col-md-9">{{ $application->expire_date }}</div>
    </div>
@endif