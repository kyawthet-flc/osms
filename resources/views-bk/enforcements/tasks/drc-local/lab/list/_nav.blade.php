<ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link" href="{{ route('tasks.drc_local.lab_index', ['applicationType' => request('applicationType'), 'labTypeStatus' => 'to_request']) }}">To Request {!! caseCounter($toReqeustCounter) !!}</a>
    </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('tasks.drc_local.lab_index', ['applicationType' => request('applicationType'), 'labTypeStatus' => 'requested']) }}">Requested To Lab {!! autoCancelledCaseCounter($reqeustedCounter) !!}</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('tasks.drc_local.lab_index', ['applicationType' => request('applicationType'), 'labTypeStatus' => 'received']) }}">Received {!! caseCounter($receivedCounter) !!}</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('tasks.drc_local.lab_index', ['applicationType' => request('applicationType'), 'labTypeStatus' => 'result']) }}">Result {!! autoCancelledCaseCounter($resultCounter) !!}</a>
        </li>
 
  </ul>
<br>
