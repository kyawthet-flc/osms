@php
    $displayExsitingFile = in_array($application->application_type,['new', 'renew']);
    $onetimeAttachments = $application->getNewStep3Files->where('application_type', 'new')->groupBy('file_field');
    $indexer = 1;
    $fileFields = array_keys($onetimeAttachments->toArray());
    $documentKeyToNames = App\Model\GeneralSetup\Document::whereIn('file_code', $fileFields)->pluck('file_name', 'file_code');
 @endphp

<x-utils.data-table class="table" :ths="['No.', 'File Name', 'File', 'Action']">   
  @foreach($onetimeAttachments as $fileField => $attachments)
    <tr>
        <td>{{ $indexer }}.</td>
        <td colspan="3">{!! $documentKeyToNames[$fileField.'']?? 'Unknown File Name' !!}</td>
    </tr>
    @foreach($attachments as $attachment) 
      <tr>
          <td></td>
          <td colspan="2">
              <a onclick="window.open('{{ route('tasks.diac.show_document', $attachment) }}', '_blank', 'fullscreen=yes'); return false;" 
              href="{{ route('tasks.diac.show_document', $attachment) }}" class="btn btn-success"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> View</a></td>
          <td>
              @if( $displayExsitingFile )
              <input type="checkbox" 
                class="incompletes"
                value="{{ $attachment->file_field }}" 
                name="incompletes[{{ $attachment->file_field }}]" />
              @endif
          </td>
      </tr>
    @endforeach
    @php $indexer++; @endphp
  @endforeach
</x-utils.data-table>