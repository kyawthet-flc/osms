@extends('layouts.app')

@section('title') Inspection Index @endsection

@section('content')
    <x-utils.card :attrs="['title' => 'Inspection Index']">

        @include('enforcements.tasks.dlmc.inspection._search')
        @include('enforcements.tasks.dlmc.inspection._nav')

        <?php
        $cols = [
            'No.',
            'Application No.',
            'Factory Name',
            'Notice File',
            'Result Status',
            'Status',
            'Action'
        ];
        ?>

        <x-utils.data-table class="table" :ths="$cols">

        @php
            $indexer = $lists->perPage() * $lists->currentPage() - $lists->perPage();
        @endphp

        @foreach ($lists as $k => $inspection)
            <tr>
                <td>{{ $k + 1 + $indexer }}.</td>
                <td>{{ $inspection->dlmcApplication->application_no }}</td>
                <td>{{ $inspection->dlmcApplication->manufacturer_name }}</td>
                <td>
                    @foreach ($inspection->drugAttachments??[] as $attachment)    
                        <a onclick="window.open('{{ route('tasks.dlmc.show_document', $attachment) }}', '_blank', 'fullscreen=yes'); return false;"
                            href="{{ route('tasks.dlmc.show_document', $attachment) }}" class="btn btn-primary">View File</a>
                    @endforeach
                </td>
                <td>{{ $inspection->inspection_result_status?? 'N/A' }}</td>
                <td>{{ $inspection->status }}</td>
                <td>
                    <a class="btn btn-info mb-2" href="{{ route('tasks.dlmc.show', ['dlmcApplication' => $inspection->dlmcApplication]) }}">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                        Application
                    </a>

                    @if ($inspection->status == 'done')
                        <br>
                        <a class="btn btn-success" href="{{ route('tasks.dlmc.inspection.edit', ['dlmcApplication' => $inspection->dlmcApplication, 'inspection' => $inspection]) }}">
                            <i class="fa fa-eye" aria-hidden="true"></i> Inspection
                        </a>
                    @else
                        <br>
                        <a class="btn btn-warning" href="{{ route('tasks.dlmc.inspection.edit', ['dlmcApplication' => $inspection->dlmcApplication, 'inspection' => $inspection]) }}">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Inspection
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach

        </x-utils.data-table>

        {{ $lists->appends(request()->all()) }}
    </x-utils.card>
@endsection
