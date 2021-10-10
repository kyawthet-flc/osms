<ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link" href="{{ route('tasks.diac.index', ['applicationType' => request('applicationType'), 'applicationStatus' => 'submitted', 'hasExtension' => request('hasExtension', 'no') ]) }}">Verify {!! caseCounter( $diacTasksByAppStatus['submitted']) !!}</a>
    </li>
 
        <li class="nav-item">
            <a class="nav-link" href="{{ route('tasks.diac.index', ['applicationType' => request('applicationType'), 'applicationStatus' => 'resubmitted', 'hasExtension' => request('hasExtension', 'no')]) }}">Return Cases {!! caseCounter($diacTasksByAppStatus['resubmitted']) !!}</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('tasks.diac.index', ['applicationType' => request('applicationType'), 'applicationStatus' => 'incomplete', 'hasExtension' => request('hasExtension', 'no')]) }}">Incomplete {!! incompleteCaseCounter($diacCommonCountArr['incomplete']) !!}</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('tasks.diac.index', ['applicationType' => request('applicationType'), 'applicationStatus' => 'auto-cancelled', 'hasExtension' => request('hasExtension', 'no')]) }}">Auto Cancelled {!! autoCancelledCaseCounter($diacCommonCountArr['auto-cancelled']) !!}</a>
        </li>    

    <li class="nav-item">
      <a class="nav-link" href="{{ route('tasks.diac.index', ['applicationType' => request('applicationType'), 'applicationStatus' => 'rejected', 'hasExtension' => request('hasExtension', 'no')]) }}">Rejected {!! rejectedCaseCounter($diacCommonCountArr['rejected']) !!}</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('tasks.diac.index', ['applicationType' => request('applicationType'), 'applicationStatus' => 'approved', 'hasExtension' => request('hasExtension', 'no')]) }}">Approved {!! approvedCaseCounter($diacCommonCountArr['approved']) !!}</a>
    </li>

  </ul>
<br>
