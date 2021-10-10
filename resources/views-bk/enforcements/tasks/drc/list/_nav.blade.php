<ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link" href="{{ route('tasks.drc.index', ['applicationType' => request('applicationType'), 'applicationStatus' => 'submitted']) }}">Verify {!! caseCounter( $drcTasksByAppStatus['submitted']) !!}</a>
    </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('tasks.drc.index', ['applicationType' => request('applicationType'), 'applicationStatus' => 'resubmitted']) }}">Return Cases {!! caseCounter($drcTasksByAppStatus['resubmitted']) !!}</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('tasks.drc.index', ['applicationType' => request('applicationType'), 'applicationStatus' => 'incomplete']) }}">Incomplete {!! incompleteCaseCounter($drcCommonCountArr['incomplete']) !!}</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('tasks.drc.index', ['applicationType' => request('applicationType'), 'applicationStatus' => 'auto-cancelled']) }}">Auto Cancelled {!! autoCancelledCaseCounter($drcCommonCountArr['auto-cancelled']) !!}</a>
        </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('tasks.drc.index', ['applicationType' => request('applicationType'), 'applicationStatus' => 'rejected']) }}">Rejected {!! rejectedCaseCounter($drcCommonCountArr['rejected']) !!}</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('tasks.drc.index', ['applicationType' => request('applicationType'), 'applicationStatus' => 'approved']) }}">Approved {!! approvedCaseCounter($drcCommonCountArr['approved']) !!}</a>
    </li>

  </ul>
<br>
