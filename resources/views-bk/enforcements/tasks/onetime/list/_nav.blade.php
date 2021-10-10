<ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link" href="{{ route('tasks.onetime.index', ['applicationType' => request('applicationType'), 'applicationStatus' => 'submitted']) }}">Verify {!! caseCounter( $onetimeTasksByAppStatus['submitted']) !!}</a>
    </li>
 
        <li class="nav-item">
            <a class="nav-link" href="{{ route('tasks.onetime.index', ['applicationType' => request('applicationType'), 'applicationStatus' => 'resubmitted']) }}">Return Cases {!! caseCounter($onetimeTasksByAppStatus['resubmitted']) !!}</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('tasks.onetime.index', ['applicationType' => request('applicationType'), 'applicationStatus' => 'incomplete']) }}">Incomplete {!! incompleteCaseCounter($onetimeCommonCountArr['incomplete']) !!}</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('tasks.onetime.index', ['applicationType' => request('applicationType'), 'applicationStatus' => 'auto-cancelled']) }}">Auto Cancelled {!! autoCancelledCaseCounter($onetimeCommonCountArr['auto-cancelled']) !!}</a>
        </li>    

    <li class="nav-item">
      <a class="nav-link" href="{{ route('tasks.onetime.index', ['applicationType' => request('applicationType'), 'applicationStatus' => 'rejected']) }}">Rejected {!! rejectedCaseCounter($onetimeCommonCountArr['rejected']) !!}</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('tasks.onetime.index', ['applicationType' => request('applicationType'), 'applicationStatus' => 'approved']) }}">Approved {!! approvedCaseCounter($onetimeCommonCountArr['approved']) !!}</a>
    </li>

  </ul>
<br>
