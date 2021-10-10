@foreach (optional($application)->inspections??[] as $k => $inspection)
    <x-utils.data-table class="table" :ths="['No.', 'Comment', 'Notice File','Result Status', 'Status', 'Action']">
        <tr>
            <td>{{ $k + 1 }}</td>
            <td>{!! $inspection->comment !!}</td>
            <td>
                @foreach ($inspection->drugAttachments??[] as $attachment)    
                    <a onclick="window.open('{{ route('tasks.dlmc.show_document', $attachment) }}', '_blank', 'fullscreen=yes'); return false;"
                        href="{{ route('tasks.dlmc.show_document', $attachment) }}" class="btn btn-primary">View File</a>
                @endforeach
            </td>
            <td>{{ $inspection->inspection_result_status?? 'N/A' }}</td>
            <td>{{ $inspection->status }}</td>
            <td>
                @if ($inspection->status == 'done')
                    <a class="btn btn-success" href="{{ route('tasks.dlmc.inspection.edit', ['dlmcApplication' => $application, 'inspection' => $inspection]) }}">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                    </a>
                @else
                    <a class="btn btn-warning" href="{{ route('tasks.dlmc.inspection.edit', ['dlmcApplication' => $application, 'inspection' => $inspection]) }}">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a>
                @endif
            </td>
        </tr>
    </x-utils.data-table>
@endforeach