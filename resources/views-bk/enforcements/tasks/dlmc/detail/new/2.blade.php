<table class="table table-bordered">
    <thead>
        <tr>
            <th class="th-td-no">No.</th>
            <th>Name</th>
            <th>Age</th>
            <th>NRC/Passport No.</th>
            <th>Address</th>
        </tr>
    </thead>
    <tbody>
    @foreach($application->dlmcSupervisings as $k => $dlmcSupervising)
        @php
            $step2Attachments = $dlmcSupervising->drugAttachments->where('sub_app_type', 'step_2')->groupBy('file_field');
            $fileFields = array_keys($step2Attachments->toArray());
            $indexer = 1;
            $documentKeyToNames = App\Model\GeneralSetup\Document::whereIn('file_code', $fileFields)->pluck('file_name', 'file_code');
        @endphp
        <tr>
            <td>{{ $k + 1 }}</td>
            <td>{{ $dlmcSupervising->applicant_name }}</td>
            <td>{{ $dlmcSupervising->applicant_age }}</td>
            <td>
                @if ($dlmcSupervising->applicant_type == 'Myanmar')
                    {{ $dlmcSupervising->region_code_no }} / {{ $dlmcSupervising->township_code }} ( {{ $dlmcSupervising->nrc_type }} ) {{ $dlmcSupervising->nrc_no }}
                @else
                    {{ $dlmcSupervising->passport }}   
                @endif
            </td>
            <td>{{ $dlmcSupervising->applicant_address }}</td>
        </tr>
        <tr>
            @foreach($step2Attachments as $fileField => $attachments)
                <td colspan="2">{!! $documentKeyToNames[$fileField.'']?? 'Unknown File Name' !!}</td>
                <td colspan="2">
                    @foreach($attachments as $attachment)
                        <a onclick="window.open('{{ route('tasks.dlmc.show_document', $attachment) }}', '_blank', 'fullscreen=yes'); return false;"
                            href="{{ route('tasks.dlmc.show_document', $attachment) }}" class="btn btn-success">View</a>
                            <td>
                                <input type="checkbox"
                                    class="incompletes"
                                    value="{{ $attachment->file_field }}"
                                    name="incompletes[{{ $attachment->file_field }}]" />
                            </td>
                    @endforeach
                </td>
            @endforeach
        </tr>
        @endforeach
    </tbody>
</table>
