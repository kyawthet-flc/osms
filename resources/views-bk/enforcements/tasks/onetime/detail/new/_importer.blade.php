<div class="row">
    <div class="col-md-3 font-weight-bold">{{ __('Importer Name') }}</div>
    <div class="col-md-9">{{ $application->importer_name }}</div>
    <div class="col-md-3 mt-2 font-weight-bold">{{ __('Nationality') }}</div>
    <div class="col-md-9 mt-2">{{ $application->nationality }}</div>

    @if( $application->nationality == 'Myanmar' )
        <div class="col-md-3 font-weight-bold">{{ __('NRC No.') }}</div>
        <div class="col-md-9">{{ $application->nrc_1 }}/{{ $application->nrc_2}}({{$application->nrc_3}}){{$application->nrc_4 }}</div>
        @if($application->nrc_old != null)
            <div class="col-md-3 mt-2 font-weight-bold">{{ __('NRC OLD') }}</div>
            <div class="col-md-9 mt-2">{{ $application->nrc_old }}</div>
        @endif
    @else
        <div class="col-md-3 mt-2 font-weight-bold">{{ __('Passport No') }}</div>
        <div class="col-md-9 mt-2">{{ $application->passport }}</div>
    @endif

        <div class="col-md-3 mt-1 font-weight-bold">{{ __('Importer Designation') }}</div>
        <div class="col-md-9 mt-1">{{ $application->importer_designation }}</div>

        {{-- <div class="col-md-3 mt-2 font-weight-bold">{{ __('Address Representative') }}</div>
        <div class="col-md-9 mt-2">{{ $application->address_1 }}</div> --}}

        <div class="col-md-3 mt-2 font-weight-bold">{{ __('Phone') }}</div>
        <div class="col-md-9 mt-2">{{ $application->phone }}</div>

        <div class="col-md-3 mt-2 font-weight-bold">{{ __('Email') }}</div>
        <div class="col-md-9 mt-2">{{ $application->email }}</div>

        <div class="col-md-3 mt-2 font-weight-bold">{{ __('Wearhouse Name') }}</div>
        <div class="col-md-9 mt-2">{{ $application->w_name }}</div>

        <div class="col-md-3 mt-2 font-weight-bold">{{ __('Wearhouse Address') }}</div>
        <div class="col-md-9 mt-2">{{ $application->w_address }}</div>

        

        <div class="col-md-3 mt-2 font-weight-bold">{{ __('DIAC') }}</div>
        <div class="col-md-9 mt-2">
            @if($application->me == 'e' && $application->diac_application_id) 
            <a href="{{route('tasks.diac.show', $application->diac_application_id)}}" target="_blank">
              {{ $application->diacApplication->certificate_no }} (E-Submission)
            </a>
            @else  
            {{ $application->diac_c_no }} (Manual)
            @endif 
        </div>
        {{-- <div class="col-md-3 mt-2 font-weight-bold">{{ __('Reason of Importation') }}</div>
        <div class="col-md-9 mt-2">{{ $application->reason }}</div> --}}
        <br><br>
        @php
          $displayExsitingFile = in_array($application->application_type,['new', 'renew']);
          $ca0 = $application->getNewStep2Files->where('application_type', 'new')->groupBy('file_field')->toArray();
          $ca1 = $application->getNewStep20Files->where('application_type', 'new')->groupBy('file_field')->toArray();
          $ca2 = $application->getNewStep21Files->where('application_type', 'new')->groupBy('file_field')->toArray();
          $combineArray_step1 = array_merge($ca0,$ca1);
          $onetimeAttachments = array_merge($combineArray_step1,$ca2);
          $indexer = 1;
          $fileFields = array_keys($onetimeAttachments);
          $documentKeyToNames = App\Model\GeneralSetup\Document::whereIn('file_code', $fileFields)->pluck('file_name', 'file_code');
        @endphp

<x-utils.data-table class="table" :ths="['No.', 'File Name', 'File', 'Action']">   
    @foreach($onetimeAttachments as $fileField => $attachments)
      <tr>
          <td>{{ $indexer }}.</td>
          <td>{!! $documentKeyToNames[$fileField.'']?? 'Unknown File Name' !!}</td>
      </tr>
      @foreach($attachments as $attachment) 
            {{-- <td>
                <a onclick="window.open('{{ route('tasks.diac.show_document', $attachment['id']) }}', '_blank', 'fullscreen=yes'); return false;" 
                href="{{ route('tasks.diac.show_document', $attachment['id']) }}" class="btn btn-success"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> View</a></td>
            <td>
                @if( $displayExsitingFile )
                <input type="checkbox" 
                  class="incompletes"
                  value="{{ $attachment['file_field'] }}" 
                  name="incompletes[{{ $attachment['file_field'] }}]" />
                @endif
            </td>
        </tr> --}}
        <tr>
            <td></td>
            <td colspan="2">
                <a onclick="window.open('{{ route('tasks.diac.show_document', $attachment['id']) }}', '_blank', 'fullscreen=yes'); return false;" 
                href="{{ route('tasks.diac.show_document', $attachment['id']) }}" class="btn btn-success"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> View</a></td>
            <td>
                @if( $displayExsitingFile )
                <input type="checkbox" 
                  class="incompletes"
                  value="{{ $attachment['file_field'] }}" 
                  name="incompletes[{{ $attachment['file_field'] }}]" />
                @endif
            </td>
        </tr>
      @endforeach
      @php $indexer++; @endphp
    @endforeach
  </x-utils.data-table>

        
</div>
