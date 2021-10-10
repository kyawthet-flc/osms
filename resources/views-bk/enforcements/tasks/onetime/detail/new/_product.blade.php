
<x-utils.data-table class="table-responsive" :ths="['No.', 'Brand Name', 'Generic Name', 'Quantity','Presentation (Pack Size)','Store Condition','Manufacturer', 'Country of Origin', 'Seller Address', 'Reason', 'DRC']">   
    @foreach($application->onetimeProductLists as $index => $oneProduct)
      <tr>
          <td>{{ $index + 1 }}.</td>
          {{-- <td>{{ $oneProduct->drug_name }}</td> --}}
          <td>{{ $oneProduct->brand_name }}</td>
          <td>{{ $oneProduct->generic_name }}</td>
          <td>{{ $oneProduct->quantity }}</td>
          {{-- <td>{{ $oneProduct->pk_no_unit }}</td> --}}
          <td>{{ $oneProduct->presentation }}</td>
          <td>{{ $oneProduct->store_condition }}</td>
          <td>{{ $oneProduct->seller_name }}</td>
          <td>{{ $oneProduct->seller_country }}</td>
          <td>{{ $oneProduct->seller_address }}</td>
          <td>{{ $oneProduct->purpose->name }}</td>
          <td>
            @if($oneProduct->me == 'e' && $oneProduct->drc_application_id) 
            <a href="{{route('tasks.drc.show', $oneProduct->drc_application_id)}}" target="_blank">
              {{ $oneProduct->drcApplication ? $oneProduct->drcApplication->certificate_no : '' }} (E-Submission)
            </a>
            @else  
            {{ $oneProduct->drc_c_no }} (Manual)
            @endif
          </td>
      </tr>
      @php
          $displayExsitingFile = in_array($application->application_type,['new', 'renew']);
          $ca0 = $application->getNewStep1Files->where('application_type', 'new')->where('relation_id', $oneProduct->id)->groupBy('file_field')->toArray();
          $ca1 = $application->getNewStep10Files->where('application_type', 'new')->where('relation_id', $oneProduct->id)->groupBy('file_field')->toArray();
          $ca2 = $application->getNewStep11Files->where('application_type', 'new')->where('relation_id', $oneProduct->id)->groupBy('file_field')->toArray();
          $ca3 = $application->getNewStep12Files->where('application_type', 'new')->where('relation_id', $oneProduct->id)->groupBy('file_field')->toArray();
          $ca4 = $application->getNewStep101Files->where('application_type', 'new')->where('relation_id', $oneProduct->id)->groupBy('file_field')->toArray();
          $combineArray_step1 = array_merge($ca0,$ca1);
          $combineArray_step2 = array_merge($combineArray_step1,$ca2);
          $combineArray_step3 = array_merge($combineArray_step2,$ca3);
          $onetimeAttachments = array_merge($combineArray_step3,$ca4);
          $indexer = 1;
          $fileFields = array_keys($onetimeAttachments);
          $documentKeyToNames = App\Model\GeneralSetup\Document::whereIn('file_code', $fileFields)->pluck('file_name', 'file_code');
      @endphp
      @foreach($onetimeAttachments as $fileField => $attachments)
        <tr>
          <td></td>
          <td>{{ $indexer }}.</td>
          <td colspan="6">{!! $documentKeyToNames[$fileField.'']?? 'Unknown File Name' !!}</td>
      </tr>
      @foreach($attachments as $attachment) 
        <tr>
            <td></td>
            <td></td>
            <td colspan="6">
                <a onclick="window.open('{{ route('tasks.diac.show_document', $attachment['id']) }}', '_blank', 'fullscreen=yes'); return false;" 
                href="{{ route('tasks.diac.show_document', $attachment['id']) }}" class="btn btn-success"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> View</a></td>
            <td colspan="6">

                @if( $displayExsitingFile )
                <input type="hidden" value="{{$oneProduct->id}}" name="product_id">
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
    @endforeach
</x-utils.data-table>

