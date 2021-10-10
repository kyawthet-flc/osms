@php
    $inspectStatus = auth()->user()->inspectStatus();
@endphp
<ul class="nav nav-tabs">
  
    <li class="nav-item">
      <a class="nav-link" href="{{ route('tasks.dlmc.inspection.index', [ 'inspectionStatus' => 'inspect']) }}">Verify {!! caseCounter( $inspectStatus['inspect']) !!}</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('tasks.dlmc.inspection.index', [ 'inspectionStatus' => 'send']) }}">Sent To</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('tasks.dlmc.inspection.index', [ 'inspectionStatus' => 'submitted']) }}">Return Cases {!! caseCounter($inspectStatus['submitted']) !!}</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('tasks.dlmc.inspection.index', ['inspectionStatus' => 'incomplete']) }}">Incomplete</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('tasks.dlmc.inspection.index', [ 'inspectionStatus' => 'done']) }}">Done</a>
    </li>

  </ul>
<br>
