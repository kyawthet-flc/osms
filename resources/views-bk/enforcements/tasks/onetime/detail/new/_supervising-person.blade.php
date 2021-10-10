<!-- Lazy Eager Loading -->
@php
   $application->load(['diacSupervisingPeople.attachments']);
@endphp
{{--
@foreach($application->diacSupervisingPeople as $diacSupervisingPerson)
<div class="row mb-4">
    <div class="col-md-3">{{ __('Name') }}</div>
    <div class="col-md-9">{{ $diacSupervisingPerson->name }}</div>
 
    <div class="col-md-3">{{ __('Qualification') }}</div>
    <div class="col-md-9">{{ $diacSupervisingPerson->qualification }}</div>
 
    <div class="col-md-3">{{ __('Duties') }}</div>
    <div class="col-md-9">{{ $diacSupervisingPerson->duties }}</div>

    <div class="col-md-12">
        @foreach($diacSupervisingPerson->attachments as $attachment)
        {{ $attachment }}
        @endforeach
    </div>
</div>
@endforeach
--}}

<x-utils.data-table class="table" :ths="['No.', 'Name', 'Qualification', 'Duties', 'Necessary Documents']">   
    @foreach($application->diacSupervisingPeople as $indexer => $diacSupervisingPerson)
    <tr>
        <td>{{ $indexer + 1 }}.</td>
        <td>{{ $diacSupervisingPerson->name }}</td>
        <td>{{ $diacSupervisingPerson->qualification }}</td>
        <td>{{ $diacSupervisingPerson->duties }}</td>
        <td>
        @foreach($diacSupervisingPerson->attachments as $attachment)
          <a onclick="window.open('{{ route('tasks.diac.show_document', $attachment) }}', '_blank', 'fullscreen=yes'); return false;" href="{{ route('tasks.diac.show_document', $attachment) }}" class="btn btn-success btn-sm">View</a>
        @endforeach
        </td>
    </tr>
    @endforeach
</x-utils.data-table>