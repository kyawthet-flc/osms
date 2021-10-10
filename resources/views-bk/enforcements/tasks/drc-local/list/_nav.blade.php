<ul class="nav nav-tabs">
  
    <li class="nav-item">
      <a class="nav-link" href="{{ route('tasks.drc_local.index', ['applicationType' => request('applicationType'), 'applicationStatus' => 'submitted']) }}">Verify {!! caseCounter( $drcLocalTasksByAppStatus['submitted']) !!}</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('tasks.drc_local.index', ['applicationType' => request('applicationType'), 'applicationStatus' => 'resubmitted']) }}">Return Cases {!! caseCounter($drcLocalTasksByAppStatus['resubmitted']) !!}</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('tasks.drc_local.index', ['applicationType' => request('applicationType'), 'applicationStatus' => 'incomplete']) }}">Incomplete {!! incompleteCaseCounter($drcLocalCommonCountArr['incomplete']) !!}</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('tasks.drc_local.index', ['applicationType' => request('applicationType'), 'applicationStatus' => 'auto-cancelled']) }}">Auto Cancelled {!! autoCancelledCaseCounter($drcLocalCommonCountArr['auto-cancelled']) !!}</a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('tasks.drc_local.index', ['applicationType' => request('applicationType'), 'applicationStatus' => 'rejected']) }}">Rejected {!! rejectedCaseCounter($drcLocalCommonCountArr['rejected']) !!}</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('tasks.drc_local.index', ['applicationType' => request('applicationType'), 'applicationStatus' => 'approved']) }}">Approved {!! approvedCaseCounter($drcLocalCommonCountArr['approved']) !!}</a>
    </li>

  </ul>
<br>
