<div class="row mb-2">
    <div class="col-md-12 text-center">
        <h5>Company Information</h5>
    </div>
    <div class="col-md-3 mb-2">{{ __('Company Name') }}</div>
    <div class="col-md-9 mb-2">{{ $application->company_name }}</div>
    <div class="col-md-3 mb-2">{{ __('Company Address') }}</div>
    <div class="col-md-9 mb-2">{{ $application->company_address }}</div>
    <div class="col-md-3 mb-2">{{ __('Company Phone') }}</div>
    <div class="col-md-9 mb-2">{{ $application->company_phone }}</div>
    <div class="col-md-3 mb-2">{{ __('Company Email') }}</div>
    <div class="col-md-9 mb-2">{{ $application->company_email }}</div>

    @if ( !empty($application->is_an_applicant) )    
        <div class="col-md-3 mb-2">{{ __('is an applicatn holder of other pharmaceutical business licence(s)?') }}</div>
        <div class="col-md-9 mb-2">{{ $application->is_an_applicant }}</div>
        <div class="col-md-3 mb-2">{{ __('Type of License') }}</div>
        <div class="col-md-9 mb-2">{{ $application->type_of_licence }}</div>
        <div class="col-md-3 mb-2">{{ __('Licence No') }}</div>
        <div class="col-md-9 mb-2">{{ $application->licence_no }}</div>
        <div class="col-md-3 mb-2">{{ __('Date Of issue') }}</div>
        <div class="col-md-9 mb-2">{{ $application->date_of_issue }}</div>
    @endif
    <div class="col-md-12 text-center mt-4">
        <h5>Factory Information</h5>
    </div>
    <div class="col-md-3 mb-2">{{ __('Factory Name') }}</div>
    <div class="col-md-9 mb-2">{{  $application->manufacturer_name}}</div>
    <div class="col-md-3 mb-2">{{ __('Factory Phone') }}</div>
    <div class="col-md-9 mb-2">{{ $application->manufacturer_phone }}</div>
    <div class="col-md-3 mb-2">{{ __('Factory Email') }}</div>
    <div class="col-md-9 mb-2">{{ $application->manufacturer_email }}</div>
    <div class="col-md-3 mb-2">{{ __('Factory Address') }}</div>
    <div class="col-md-9 mb-2">{{ $application->manufacturer_address }}</div>
    <div class="col-md-3 mb-2">{{ __('Type of Factory') }}</div>
    <div class="col-md-9 mb-2">{{ $application->type_of_factory }}</div>
    <div class="col-md-3 mb-2">{{ __('Working Hours') }}</div>
    <div class="col-md-9 mb-2">{{ $application->working_hour }}</div>
    <div class="col-md-3 mb-2">{{ __('Number of Staff in Production') }}</div>
    <div class="col-md-9 mb-2">{{ $application->production }}</div>
    <div class="col-md-3 mb-2">{{ __('Number of Staff in Quality Control') }}</div>
    <div class="col-md-9 mb-2">{{ $application->qc }}</div>
    <div class="col-md-3 mb-2">{{ __('Number of Staff in Stograge and Distribution') }}</div>
    <div class="col-md-9 mb-2">{{ $application->storage }}</div>
</div>
@php
    $step1Attachments = $application->drugAttachments->where('sub_app_type', 'step_1')->groupBy('file_field');
    $fileFields = array_keys($step1Attachments->toArray());
    $indexer = 1;
    $documentKeyToNames = App\Model\GeneralSetup\Document::whereIn('file_code', $fileFields)->pluck('file_name', 'file_code');
@endphp
<br>
<x-utils.data-table class="table" :ths="['No.', 'File Name', 'File', 'Action']">
    @foreach($step1Attachments as $fileField => $attachments)
        <tr>
            <td>{{ $indexer }}.</td>
            <td colspan="3">{!! $documentKeyToNames[$fileField.'']?? 'Unknown File Name' !!}</td>
        </tr>
        @foreach($attachments as $attachment)
            
            <tr>
                <td></td>
                <td colspan="2">
                    <a onclick="window.open('{{ route('tasks.dlmc.show_document', $attachment) }}', '_blank', 'fullscreen=yes'); return false;"
                       href="{{ route('tasks.dlmc.show_document', $attachment) }}" class="btn btn-success">View</a></td>
                <td>
                    <input type="checkbox"
                           class="incompletes"
                           value="{{ $attachment->file_field }}"
                           name="incompletes[{{ $attachment->file_field }}]" />
                </td>
            </tr>
        @endforeach
        @php $indexer++; @endphp
    @endforeach
</x-utils.data-table>
