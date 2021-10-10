<div class="row mb-2">
    <div class="col-md-3">{{ __('Sample Quantities') }}</div>
    <div class="col-md-9">{{ $application->drcSampleInformation->sample_quantities }}</div>
</div>
<div class="row mb-2">
    <div class="col-md-3">{{ __('Sample Sent date') }}</div>
    <div class="col-md-9">{{ $application->drcSampleInformation->sample_send_date }}</div>
</div>
<div class="row mb-2">
    <div class="col-md-3">{{ __('Sample Receipt No') }}</div>
    <div class="col-md-9">{{ $application->drcSampleInformation->sample_receipt_no }}</div>
</div>
@php
    $sample = $application->drcSampleInformations->attachments->groupBy('file_field');
    $indexer = 1;
    $fileFields = array_keys($sample->toArray());
    $documentKeyToNames = App\Model\GeneralSetup\Document::whereIn('file_code', $fileFields)->pluck('file_name', 'file_code');
@endphp

<x-utils.data-table class="table" :ths="['No.', 'File Name', 'File', 'Action']">
    @foreach($sample as $fileField => $attachments)
        <tr>
            <td>{{ $indexer }}.</td>
            <td colspan="3">{!! $documentKeyToNames[$fileField.'']?? 'Unknown File Name' !!}</td>
        </tr>
        @foreach($attachments as $attachment)
            <tr>
                <td></td>
                <td colspan="2">
                    <a onclick="window.open('{{ route('tasks.drc_local.show_document', $attachment) }}', '_blank', 'fullscreen=yes'); return false;"
                       href="{{ route('tasks.drc_local.show_document', $attachment) }}" class="btn btn-success">View</a></td>
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
