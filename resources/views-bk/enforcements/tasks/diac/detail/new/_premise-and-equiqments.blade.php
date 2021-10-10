@php
    $displayExsitingFile = in_array($application->application_type,['new', 'renew']) || ($application->application_type == 'amend' && $application->has_extension == 'yes');
    $premiseAndEquiAttachments = $application->attachments->where('application_type', 'new')->groupBy('file_field');
    $indexer = 1;
    $fileFields = array_keys($premiseAndEquiAttachments->toArray());
    $documentKeyToNames = App\Model\GeneralSetup\Document::whereIn('file_code', $fileFields)->pluck('file_name', 'file_code');
 @endphp

<x-utils.data-table class="table" :ths="['No.', 'File Name', 'File', 'Action']">
  @php $deduplicateCheckboxes = array(); @endphp
  @foreach($premiseAndEquiAttachments as $fileField => $attachments)
    <tr>
        <td>{{ $indexer }}.</td>
        <td colspan="3">{!! $documentKeyToNames[$fileField.'']?? 'Unknown File Name' !!}</td>
    </tr>
    @foreach($attachments as $attachment) 
      <tr>
          <td></td>
          <td colspan="2">
              <a onclick="window.open('{{ route('tasks.diac.show_document', $attachment) }}', '_blank', 'fullscreen=yes'); return false;" 
              href="{{ route('tasks.diac.show_document', $attachment) }}" class="btn btn-success">View</a></td>
          <td>
              @if( $displayExsitingFile && !isset($deduplicateCheckboxes[$attachment->file_field]) )
                <input type="checkbox" 
                  class="incompletes"
                  value="{{ $attachment->file_field }}" 
                  name="incompletes[{{ $attachment->file_field }}]" />
              @endif
          </td>
      </tr>
       @php $deduplicateCheckboxes[$attachment->file_field] = $attachment->file_field; @endphp
    @endforeach
    @php $indexer++; @endphp
  @endforeach
</x-utils.data-table>