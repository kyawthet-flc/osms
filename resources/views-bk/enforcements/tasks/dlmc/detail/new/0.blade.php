<div class="row mb-2">
    <div class="col-md-3 mb-2">{{ __('Application Date') }}</div>
    <div class="col-md-9 mb-2">
       {{ optional($application->dlmcActionRecord)->submitted_at }}
    </div>
    <div class="col-md-3 mb-2">{{ __('Application No.') }}</div>
    <div class="col-md-9 mb-2">{{ $application->application_no }}</div>
</div>
@if ( isset($application->temp_issue_date ))
    <div class="row">
        <div class="col-md-3 mb-2">{{ __('Temporary Licence Issue Date') }}</div>
        <div class="col-md-9 mb-2">{{ $application->temp_issue_date }}</div>

        <div class="col-md-3 mb-2">{{ __('Temporary Licence Expire Date') }}</div>
        <div class="col-md-9 mb-2">{{ $application->temp_expire_date }}</div>
    </div>
@endif
@if( isset($application->certificate_no) )
    <div class="row">
        <div class="col-md-3 mb-2">{{ __('Certificate No.') }}</div>
        <div class="col-md-9 mb-2">{{ $application->certificate_no }}</div>
 
        <div class="col-md-3 mb-2">{{ __('Issue Date') }}</div>
        <div class="col-md-9 mb-2">{{ $application->issue_date }}</div>

        <div class="col-md-3 mb-2">{{ __('Expiry Date') }}</div>
        <div class="col-md-9 mb-2">{{ $application->expire_date }}</div>
    </div>
@endif